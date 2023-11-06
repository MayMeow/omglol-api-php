<?php

namespace MayMeow\Omglol\Services\Http;

interface OmgLolClientInterface
{
    public function get(string $url);

    public function post(string $url, array $data);
}