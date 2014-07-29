<?php

include ('DomainAvailability.php');  
$Domain = new DomainAvailability(true);
$available = $Domain->is_available("helgesverre.com");

if ($available) {
    echo "The domain is not registered";
} else {
    echo "The domain is registered";
}

?>