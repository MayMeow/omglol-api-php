<?php

use MayMeow\Omglol\Model\Purl\PurlData;
use MayMeow\Omglol\Services\StatusLogService;
use Meow\Hydrator\Hydrator;

require_once "vendor/autoload.php";

$testString = '{
    "request": {
        "status_code": 200,
        "success": true
    },
    "response": {
        "message": "Here are the PURLs for foo.",
        "purls": [
            {
                "name": "awesome",
                "url": "https://www.youtube.com/watch?v=dQw4w9WgXcQ",
                "counter": "872"
            },
            {
                "name": "💚",
                "url": "https://example.com",
                "counter": "33"
            }
        ]
    }
}';

$hydrator = new Hydrator();
$model = $hydrator->hydrate(PurlData::class, json_decode($testString, true));

//var_dump($model);

//$message = new StatusMessage('Ahoj svet', '👩');

//var_dump($message->getMessageData(isJsonEncoded: false));

