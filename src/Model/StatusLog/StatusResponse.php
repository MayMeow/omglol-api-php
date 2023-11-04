<?php
namespace MayMeow\Omglol\Model\StatusLog;

use MayMeow\Omglol\Model\Http\Response;
use Meow\Hydrator\Attributes\ArrayOf;

final class StatusResponse extends Response
{
    public Status $status;

    #[ArrayOf(Status::class)]
    public array $statuses;

    public string $id;
    public string $url;
    public string $external_url;

    public string $bio;
    public string $css;
}