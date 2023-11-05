<?php

namespace MayMeow\Omglol\Services\Http;

interface OmgLolClientInterface
{
    public function get(string $url);
}