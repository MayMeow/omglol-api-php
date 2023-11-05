<?php

namespace MayMeow\Omglol\Services;

use MayMeow\Omglol\Model\StatusLog\StatusLog;
use MayMeow\Omglol\Services\Http\OmgLolClient;
use MayMeow\Omglol\Services\Http\OmgLolClientInterface;
use Meow\Hydrator\Hydrator;

class StatusLogService implements StatusLogServiceInterface
{
    protected Hydrator $hydrator;

    public function __construct(
        protected string $token,
        protected ?OmgLolClientInterface $client = null,
    )
    {
        if (!$client) {
            $this->client = new OmgLolClient($token);
        }
        $this->hydrator = new Hydrator();
    }

    /**
     * Retrieve all statuses
     *
     * @param string|null $address if address is not defined it will return entrie statusLog otherwise all statuses for address
     * @return array<Status>
     */
    public function getAllStatuses(?string $address = null): array
    {
        if ($address) {
            $response  = $this->client->get(sprintf('/address/%s/statuses', $address));
        } else {
            $response  = $this->client->get('/statuslog');
        }

        /** @var StatusLog $statuses */
        $statuses = $this->hydrator->hydrate(StatusLog::class, json_decode($response->getContent(), true));

        return $statuses->response->statuses;
    }
}