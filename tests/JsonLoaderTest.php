<?php

namespace Helge\Tests;

use Helge\Loader\JsonLoader;

class JsonLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * This test ensures that the Load function of the JsonLoader returns a non-empty array when loading the bundled servers.son
     */
    public function testJsonLoaderLoad()
    {
        $loader = new JsonLoader("src/data/servers.json");
        $this->assertNotEmpty($loader->load());
    }

    /**
     * This test checks that the Load function returns false if it has not been provided a path
     */
    public function testJsonLoaderNoPath()
    {
        $loader = new JsonLoader();
        $this->assertFalse($loader->load());
    }

    /**
     * This test checks that the Load function returns false if the file in the provided path does not exist
     */
    public function testJsonLoaderFileNotExist()
    {
        $loader = new JsonLoader('src/data/file_that_does_not_exist.json');
        $this->assertFalse($loader->load());
    }

    /**
     * This test covers the accessors and mutators of the path property
     */
    public function testJsonLoaderGetAndSet()
    {
        $loader = new JsonLoader("src/data/construction_value");
        $this->assertEquals(
            "src/data/construction_value",
            $loader->getPath(),
            'getPath() did not return the value that the loader was instantiated with'
        );

        $loader->setPath("src/data/set_value");
        $this->assertEquals(
            "src/data/set_value",
            $loader->getPath(),
            'getPath() did not return the value provided to setPath()'
        );
    }
}
