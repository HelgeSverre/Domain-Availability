<?php

namespace Helge\Tests;

use Helge\Client\SimpleWhoisClient;

class SimpleWhoisClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Helge\Client\WhoisClientInterface
     */
    protected $whoisClient;

    public function setup()
    {
        $this->whoisClient = new SimpleWhoisClient();
    }

    public function testGetAndSetServer()
    {
        $client = new SimpleWhoisClient();
        $client->setServer('whois.verisign-grs.com');
        $this->assertEquals('whois.verisign-grs.com', $client->getServer());
    }

    public function testDefaultPort()
    {
        $client = new SimpleWhoisClient();
        $this->assertEquals(43, $client->getPort());
    }

    public function testGetAndSetPort()
    {
        $client = new SimpleWhoisClient();
        $client->setPort(443);
        $this->assertEquals(443, $client->getPort());
    }

    public function testQueryValidWhoisServer()
    {
        $client = new SimpleWhoisClient('whois.verisign-grs.com');
        $this->assertTrue(
            $client->query('example.com'),
            'Querying a valid Whois Server should return true'
        );

        $this->assertNotEmpty(
            $client->getResponse(),
            'After querying a valid Whois Server, response data should be available'
        );
    }

    public function testQueryInvalidWhoisServer()
    {
        $client = new SimpleWhoisClient('localhost'); // We are assuming that the local machine doesnt have a whois server
        $this->assertFalse(
            $client->query('example.com'),
            'Querying a Whois server that cannot be connected to should return false'
        );
    }


}
