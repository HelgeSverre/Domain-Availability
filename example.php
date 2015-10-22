<?php

use HelgeSverre\Client\SimpleWhoisClient;
use HelgeSverre\Parser\Php;
use HelgeSverre\Service\DomainAvailability;


$parser = new Php(__DIR__ . "/src/data/serverList.php");
$client = new SimpleWhoisClient();


$service = new DomainAvailability($parser, $client);

if ($service->isAvailable("helgesverre.me")) {
    echo "yay!";
} else {
    echo "nay!";
}