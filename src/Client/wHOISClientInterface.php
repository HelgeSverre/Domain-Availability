<?php

namespace Helge\Client;

interface WhoisClientInterface
{
    public function setServer($server);

    public function getServer();

    public function setPort($port);

    public function getPort();

    public function query($domainName);

    public function getResponse();
}