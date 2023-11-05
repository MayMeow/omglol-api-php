<?php

namespace MayMeow\Omglol\Services;

use MayMeow\Omglol\Model\StatusLog\Status;
use MayMeow\Omglol\Model\StatusLog\StatusResponse;

interface StatusLogServiceInterface
{
    /**
     * Fetch a single Statuslog entry
     * address and staus id is required
     */
    public function getSIngleStatus(string $address, string $statusID): Status;

    /**
     * Undocumented function
     *
     * @param string|null $address if address is not defined it will return entrie statusLog otherwise all statuses fro address
     * @return array
     */
    public function getAllStatuses(?string $address = null): array;

    //public function createStatus(): StatusResponse;

    //public function updateStatus(): StatusResponse;

    public function getBio(string $address): StatusResponse;

    /**
     * retrieve everyones latest statuses
     */
    //public function getLatest(): array;
}