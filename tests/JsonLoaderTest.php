<?php

namespace Helge\Tests;

use Helge\Loader\JsonLoader;

class JsonLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Helge\Loader\JsonLoader
     */
    protected $jsonLoader;

    public function setup()
    {

        require 'vendor/autoload.php';


        $this->jsonLoader = new JsonLoader();


    }


    // TODO(22 okt 2015) ~ Helge: Write tests


}
