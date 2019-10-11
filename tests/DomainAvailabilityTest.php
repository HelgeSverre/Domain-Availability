<?php

namespace Helge\Tests;

use Helge\Client\SimpleWhoisClient;
use Helge\Loader\JsonLoader;
use Helge\Service\DomainAvailability;

class DomainAvailabilityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Helge\Service\DomainAvailability
     */
    protected $service;

    /**
     * @var JsonLoader
     */
    protected $jsonLoader;

    public function setup()
    {
        $whoisClient = new SimpleWhoisClient();
        $this->jsonLoader = new JsonLoader("src/data/servers.json");
        $this->service = new DomainAvailability($whoisClient, $this->getJsonLoader());
    }

    public function testSupportTldsReturnsArray()
    {
        $this->assertTrue(
            is_array($this->getService()->supportedTlds()),
            'getSupportedTlds() is expected to return an array'
        );
    }

    public function testQuickDomainIsAvailableTest()
    {
        // example.com should always be resolvable by gethostbyname() due to rfc2606
        $this->assertFalse($this->getService()->isAvailable('example.com', true));
    }

    public function testDomainNotAvailable()
    {
        $this->assertFalse(
            $this->getService()->isAvailable('example.com'),
            'example.com is expected to not be available due to rfc2606'
        );
    }

    public function testDomainIsAvailable()
    {
        $this->assertTrue(
            $this->getService()->isAvailable('helge-sverre-domain-availability.com'),
            'helge-sverre-domain-availability.com is expected to be reporated as available'
        );
    }

    /**
     * @throws \Exception
     */
    public function testUnsupportedTld()
    {
        $this->expectExceptionMessage('No WHOIS entry was found for that TLD');

        $this->getService()->isAvailable('bar.app');
    }



    /**
     * @return DomainAvailability
     */
    protected function getService()
    {
        return $this->service;
    }

    /**
     * @return JsonLoader
     */
    protected function getJsonLoader()
    {
        return $this->jsonLoader;
    }
}
