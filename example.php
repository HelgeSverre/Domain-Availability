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

$whoisClient = new SimpleWhoisClient();
$dataLoader = new JsonLoader("src/data/servers.json");

$service = new DomainAvailability($whoisClient, $dataLoader);
?>

<div>
    <form style="margin: 10px;" action="" method="get">
        <label for="domain">Domain Name</label>
        <input type="text" name="domain" id="domain">
        <input type="submit" value="Go">
    </form>

    <form style="margin: 10px;" action="" method="get">
        <input type="text" name="tld" id="tld" value="list" hidden>
        <input type="submit" value="List All TLDs">
    </form>

    <?php if (isset($_GET["tld"]) && $_GET["tld"] == "list" ) : ?>
        <ul>
            <?php foreach ($service->supportedTlds() as $tld) : ?>
                <li><?= $tld; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <table border="1" cellpadding="5">
        <tr>
            <td>Status</td>
            <td>
                <?php

                try {
                    if (isset($_GET["domain"])) {
                        if ($service->isAvailable($_GET["domain"])) {
                            echo "<span style='color:green;'>Available</span>";
                        } else {
                            echo "<span style='color:red;'>Unavailable</span>";
                        }
                    }
                } catch (\Exception $e) {
                    echo $e->getMessage();
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>WHOIS Server</td>
            <td><?= $whoisClient->getServer() ?></td>
        </tr>
        <tr>
            <td>Server Port</td>
            <td><?= $whoisClient->getPort() ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <pre><?= $whoisClient->getResponse(); ?></pre>
            </td>
        </tr>
    </table>

</div>
</body>
</html>

