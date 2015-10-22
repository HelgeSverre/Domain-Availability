<?php


use Helge\Service\DomainAvailability;

require './vendor/autoload.php';

$whoisClient = new Helge\Client\SimpleWhoisClient();
$whoisClient->setPort(43);
$whoisClient->setServer("asdasdasd");

$test = $whoisClient->query("helgesverre.net");
var_dump($test);

$availabilityService = new DomainAvailability($whoisClient);

echo "\n---------------\n";
var_dump($availabilityService->isAvailable("helgesverre.com"));
var_dump($availabilityService->isAvailable("helgesverre.com", true));
echo "\n---------------\n";
var_dump($availabilityService->isAvailable("asdasdasdfggggggg222e.com"));
var_dump($availabilityService->isAvailable("asdasdasdfggggggg222e.com", true));
echo "\n---------------\n";
