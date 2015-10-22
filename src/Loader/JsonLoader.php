<?php
/**
 * Created by PhpStorm.
 * User: hehe
 * Date: 22.10.2015
 * Time: 14:30
 */

namespace Helge\Loader;


class JsonLoader implements LoaderInterface
{

    protected $path;

    public function __construct($path = false)
    {
        if ($path) $this->path = $path;
    }

    public function load()
    {
        if ($this->path) {
            if (file_exists($this->path)) {

                $contents = file_get_contents($this->path);
                return json_decode($contents, true);
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }
}