<?php
namespace MayMeow\Omglol\Model\Purl;

use MayMeow\Omglol\Model\Http\Response;
use Meow\Hydrator\Attributes\ArrayOf;

final class PurlResponse extends Response
{
    public string $name;
    public string $url;
    public Purl $purl;

    #[ArrayOf(Purl::class)]
    public array $purls;
}