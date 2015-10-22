<?php

namespace Helge\Client;


/**
 * A simple WHOIS Server client that connects to the specified server and sends a whois query according to RFC3912
 * Class simpleWhoisClient
 * @author Helge Sverre
 * @package HelgeSverre\Client
 */
class SimpleWhoisClient implements WhoisClientInterface
{
    protected $server;

    protected $port = 43;

    protected $response;
    
    public function __construct($server = false, $port = 43) {
        if ($server) $this->server = $server;
        if ($port) $this->port = $port;
    }

    /**
     * @param string $domain the domain name to get whois data for
     */
    public function query($domain)
    {
        // Initialize the response to null
        $response = null;

        // Get the filePointer to the socket connection
        $filePointer = @fsockopen($this->server, $this->port); // Suppress warnings

        // Check if we have a file pointer
        if ($filePointer) {

            // Send our query to the file pointer
            fwrite($filePointer, self::formatQueryString($domain));

            // Append the response from the server to the response variable until end of file is reached
            while (!feof($filePointer)) {
                $response .= fgets($filePointer, 128);
            }

            // Close the file pointer
            fclose($filePointer);
        } else {
            return false;
        }

        // return the response, even if we never sent a request
        $this->response = $response;

        return true;
    }

    private static function formatQueryString($queryString)
    {
        $temp = strtolower($queryString);
        $temp = trim($temp);

        // Format the domain query according to RFC3912
        return $temp . "\r\n";
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string the whois server
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param mixed $server
     */
    public function setServer($server)
    {
        $this->server = $server;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }


}