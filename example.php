<?php


use Helge\Loader\JsonServerLoader;
use Helge\Service\DomainAvailability;
use Helge\Client\SimpleWhoisClient;

require './vendor/autoload.php';

$whoisClient = new SimpleWhoisClient();
$loader = new JsonServerLoader("data/servers.json");
$service = new DomainAvailability($whoisClient, $loader);

var_dump($service->isAvailable("helgesverre.net"));