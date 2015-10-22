<?php

namespace Helge\Loader;

interface ServerLoaderInterface
{

    public function __construct($path);

    public function load();


}