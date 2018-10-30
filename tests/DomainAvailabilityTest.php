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
