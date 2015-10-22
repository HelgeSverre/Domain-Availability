<?php

namespace Helge\Tests;

use Helge\Client\SimpleWhoisClient;

class SimpleWhoisClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Helge\Client\WhoisClientInterface
     */
    protected $whoisClient;

    public function setup()
    {

        require 'vendor/autoload.php';


        $this->whoisClient = new SimpleWhoisClient();


    }


    // TODO(22 okt 2015) ~ Helge: Write tests


}
