<?php

namespace MayMeow\Omglol\Tests;

use MayMeow\Omglol\Services\Http\OmgLolClientInterface;

class TestClient implements OmgLolClientInterface
{
    public function get(string $url)
    {
        if ($url === '/address/adam/statuses') {
            return new TestResponse($this->returnAll());
        }

        if ($url === '/statuslog') {
            return new TestResponse($this->getStatusLog());
        }

        if ($url === '/address/foo/statuses/6336318079242') {
            return new TestResponse($this->getSingleStatus());
        }

        if ($url === '/address/adam/statuses/bio') {
            return new TestResponse($this->getStatusLogBio());
        }

        if ($url === '/statuslog/latest') {
            return new TestResponse($this->getLatest());
        }
    }

    public static function getTestDataFor(string $url): array
    {
        $client = new self();

        return json_decode($client->get($url)->getContent(), true);
    }

    /**
     * Undocumented function
     * GET /address/adam/statuses
     *
     * @return string
     */
    protected function returnAll(): string
    {
        return '{
            "request": {
                "status_code": 200,
                "success": true
            },
            "response": {
                "message": "Here are foo’s statuses.",
                "statuses": [
                    {
                        "id": "6335ec5bee31a",
                        "address": "foo",
                        "created": "1664478299",
                        "emoji": "😄",
                        "content": "I’m doing great!"
                    },
                    {
                        "id": "6334d1c11917a",
                        "address": "foo",
                        "created": "1664405953",
                        "emoji": "☕️",
                        "content": "Enjoying my coffee."
                    }
                ]
            }
        }';
    }

    protected function getStatusLog(): string
    {
        return '{
            "request": {
                "status_code": 200,
                "success": true
            },
            "response": {
                "message": "Here’s the complete statuslog.",
                "statuses": [
                    {
                        "id": "6391416a125e8",
                        "address": "dm",
                        "created": "1670463850",
                        "relative_time": "28 minutes ago",
                        "emoji": "☺",
                        "content": "Streamed a discussion on HRD\'s YouTube channel"
                    },
                    {
                        "id": "63913d4127ad9",
                        "address": "skoobz",
                        "created": "1670462785",
                        "relative_time": "45 minutes ago",
                        "emoji": "📺",
                        "content": "Watching Ink Master"
                    }
                ]
            }
        }';
    }

    public function getSingleStatus(): string
    {
        return '{
            "request": {
                "status_code": 200,
                "success": true
            },
            "response": {
                "message": "Here’s the status at foo.status.lol/6336318079242.",
                "status": {
                    "id": "6336318079242",
                    "address": "foo",
                    "created": "1664496000",
                    "emoji": "☕️",
                    "content": "Enjoying my coffee!"
                }
            }
        }';
    }

    public function getStatusLogBio(): string
    {
        return '{
            "request": {
                "status_code": 200,
                "success": true
            },
            "response": {
                "message": "Here’s the bio for foo’s Statuslog page.",
                "bio": "# Foo\nThis is my bio!",
                "css": ""
            }
        }';
    }

    public function getLatest()
    {
        return '{
            "request": {
                "status_code": 200,
                "success": true
            },
            "response": {
                "message": "Here are everyone’s latest statuses.",
                "statuses": [
                    {
                        "id": "638ff5cfaa031",
                        "address": "cm",
                        "created": "1670378959",
                        "relative_time": "1 day ago",
                        "emoji": "🤔",
                        "content": "Excited about omg.lol!"
                    },
                    {
                        "id": "638ff59bd1be8",
                        "address": "moe",
                        "created": "1670378907",
                        "relative_time": "1 day ago",
                        "emoji": "👀",
                        "content": "Browsing [omg.lol - Statuslog](https://home.omg.lol/address/moe/statuslog)."
                    }
                ]
            }
        }';
    }
}