<?php
require('src/AvailabilityService.php');
$domain = new HelgeSverre\DomainAvailability\AvailabilityService(true);
$available = $domain->isAvailable("helgesverre.com");

if ($available) {
    echo "The domain is not registered";
} else {
    echo "The domain is registered";
}

