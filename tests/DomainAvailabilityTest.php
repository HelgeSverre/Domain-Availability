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

    public function setup()
    {

        require 'vendor/autoload.php';

        $whoisClient = new SimpleWhoisClient();
        $dataLoader = new JsonLoader("src/data/servers.json");
        $this->service = new DomainAvailability($whoisClient, $dataLoader);


    }


    // TODO(22 okt 2015) ~ Helge: Write tests
}
