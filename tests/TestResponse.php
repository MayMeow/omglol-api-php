<?php

namespace MayMeow\Omglol\Tests;

use Symfony\Contracts\HttpClient\ResponseInterface;

class TestResponse
{

    public function __construct(
        protected string $content
    )
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}