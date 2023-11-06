<?php

namespace MayMeow\Omglol\Services;

use MayMeow\Omglol\Model\StatusLog\Status;
use MayMeow\Omglol\Model\StatusLog\StatusLog;
use MayMeow\Omglol\Model\StatusLog\StatusMessage;
use MayMeow\Omglol\Model\StatusLog\StatusResponse;
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

    public function getSIngleStatus(string $address, string $statusID): Status
    {
        $response = $this->client->get(sprintf('/address/%s/statuses/%s', $address, $statusID));

        /** @var StatusLog $status */
        $status = $this->hydrator->hydrate(StatusLog::class, json_decode($response->getContent(), true));

        return $status->response->status;
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

    public function getBio(string $address): StatusResponse
    {
        $response = $this->client->get(sprintf('/address/%s/statuses/bio', $address));

        /** @var StatusLog $status */
        $status = $this->hydrator->hydrate(StatusLog::class, json_decode($response->getContent(), true));

        return $status->response;
    }

    public function getLatest(): array
    {
        $response = $this->client->get('/statuslog/latest');

        /** @var StatusLog $status */
        $status = $this->hydrator->hydrate(StatusLog::class, json_decode($response->getContent(), true));

        return $status->response->statuses;
    }

    public function createStatus(string $address, StatusMessage|string $message): StatusResponse
    {
        if ($message instanceof StatusMessage) {
            $data = $message->getMessageData();
        } else {
            $data = [
                'status' => $message
            ];}

        $response = $this->client->post(sprintf('/address/%s/statuses/', $address), $data);

        var_dump($response->getContent());

        /** @var StatusLog $status */
        $status = $this->hydrator->hydrate(StatusLog::class, json_decode($response->getContent(), true));

        return $status->response;
    }
}