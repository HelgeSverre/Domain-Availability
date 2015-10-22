<!DOCTYPE html>
<html>
<head>
    <title>Domain Availability Checker</title>
</head>
<body>
<?php

require './vendor/autoload.php';

use Helge\Loader\JsonLoader;
use Helge\Client\SimpleWhoisClient;
use Helge\Service\DomainAvailability;

$whoisClient    = new SimpleWhoisClient();
$dataLoader     = new JsonLoader("src/data/servers.json");

$service        = new DomainAvailability($whoisClient, $dataLoader);

if (isset($_GET["domain"])) {
    if ($service->isAvailable($_GET["domain"])) {
        echo "<h2 style='color:green;'>Available</h2>";
    } else {
        echo "<h2 style='color:red;'>Unavailable</h2>";
    }
}

?>

<form action="" method="get">
    <label for="domain"></label>
    <input type="text" name="domain" id="domain">
    <input type="submit" value="Go">
</form>
</body>
</html>

