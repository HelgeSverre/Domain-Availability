<?php


namespace Helge\Service;

use Helge\Client\WhoisClientInterface;
use Pdp\Parser;
use Pdp\PublicSuffixListManager;

class DomainAvailability
{

    protected $whoisClient;
    protected $servers;

    public function __construct(WhoisClientInterface $whoisClient, $serverList = "data/servers.json")
    {
        $this->whoisClient = $whoisClient;

        // TODO(22 okt 2015) ~ Helge: putt in loader class
        if (file_exists($serverList)) {
            $serverListJson = file_get_contents($serverList);
            $this->servers = json_decode($serverListJson);
        }
    }


    public function isAvailable($domain, $quick = false)
    {

        /**
         * If the response from gethostbyname() is anything else than the domain you
         * passed to the function, it means the domain is registered.
         *
         * This is useful for quickly checking if a domain is taken, although its not a reliable check to see if a domain is
         * so we do only rely on this to check if a domain is NOT available,
         * then do a more reliable check later, to bypass this pass false as
         * the second param to this function
         *
         */
        if ($quick) {
            if (gethostbyname($domain) !== $domain) {
                // The domain is taken
                return false;
            }
        }

        $domainInfo = $this->parse($domain);

        if (!isset($this->servers[$domainInfo["tld"]])) {
            throw new \Exception("No WHOIS entry was found for that TLD");

            $whoisServerInfo = $this->servers[$domainInfo["tld"]];


            /**
             * If for some reason you've added a WHOIS server running
             * on a non-standard port, this will make sure we specify that
             */
            if (isset($whoisServerInfo["port"])) {
                $this->whoisClient->setPort($whoisServerInfo["port"]);
            }

            // Fetch the WHOIS server from the serverlist
            $this->whoisClient->setServer($whoisServerInfo["server"]);

            // If the query fails, it returns false
            if (!$this->whoisClient->query($domainInfo["domain"])) {
                throw new \Exception("WHOIS Query failed");
            }

            // Fetch the response from the WHOIS server.
            $whoisData = $this->whoisClient->getResponse();

            // Check if the WHOIS data contains the "not found"-string
            if (strpos($whoisData, $whoisServerInfo["not_found"]) !== false) {
                return true;
            }


        } else {

        }

        // If we've come this far, the domain is not available.
        return false;
    }


    /**
     * Wrapper around Jeremy Kendall's PHP Domain Parser that parses the domain/url passed to the function and returns the Tld and Valid domain
     * @param $domain
     * @throws \InvalidArgumentException when the tld is not valid
     * @return array returns an associative array with the domain and tld
     */
    private function parse($domain)
    {
        $pslManager = new PublicSuffixListManager();
        $parser     = new Parser($pslManager->getList());

        // First check if the suffix is actually valid
        if (!$parser->isSuffixValid($domain)) {
            throw new \InvalidArgumentException("Invalid domain");
        }

        $components = [];
        $components["tld"]      = $parser->getPublicSuffix($domain);
        $components["domain"]   = $parser->getRegisterableDomain($domain);

        return $components;
    }

}

