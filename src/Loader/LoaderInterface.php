<?php

namespace Helge\Loader;

interface LoaderInterface
{

    public function __construct($path);

    public function load();


}