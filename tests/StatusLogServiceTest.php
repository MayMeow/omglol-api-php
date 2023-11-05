<?php

namespace MayMeow\Omglol\Tests;

use MayMeow\Omglol\Model\StatusLog\Status;
use MayMeow\Omglol\Model\StatusLog\StatusResponse;
use MayMeow\Omglol\Services\Http\OmgLolClientInterface;
use MayMeow\Omglol\Services\StatusLogService;
use MayMeow\Omglol\Services\StatusLogServiceInterface;
use PHPUnit\Framework\TestCase;

class StatusLogServiceTest extends TestCase
{
    protected StatusLogServiceInterface $statusLogService;

    protected function setUp(): void
    {
        $this->statusLogService = new StatusLogService('token', new TestClient());
    }

    public function testGetAllStatuses()
    {
        $statuses = $this->statusLogService->getAllStatuses('adam');
        $testData = TestClient::getTestDataFor('/address/adam/statuses');

        $i = 0;
        foreach ($statuses as $status) {
            $this->assertInstanceOf(Status::class, $status);
            $this->assertEquals($testData['response']['statuses'][$i]['id'], $status->id);
            $i++;
        }

        $this->assertCount(count($testData['response']['statuses']), $statuses);
    }

    public function testGetEntrieStatuslog()
    {
        $statuses = $this->statusLogService->getAllStatuses();
        $testData = TestClient::getTestDataFor('/statuslog');

        $i = 0;
        foreach ($statuses as $status) {
            $this->assertInstanceOf(Status::class, $status);
            $this->assertEquals($testData['response']['statuses'][$i]['id'], $status->id);
            $i++;
        }

        $this->assertCount(count($testData['response']['statuses']), $statuses);
    }

    public function testGetSingleStatus()
    {
        $status = $this->statusLogService->getSIngleStatus('foo', '6336318079242');
        $testData = TestClient::getTestDataFor('/address/foo/statuses/6336318079242');

        $this->assertInstanceOf(Status::class, $status);
        $this->assertEquals($testData['response']['status']['id'], $status->id);
    }

    public function testGetStatuslogBio()
    {
        $status = $this->statusLogService->getBio('adam');
        $testData = TestClient::getTestDataFor('/address/adam/statuses/bio');

        $this->assertInstanceOf(StatusResponse::class, $status);
        $this->assertEquals($testData['response']['bio'], $status->bio);
    }

    public function testGetLatest()
    {
        $statuses = $this->statusLogService->getLatest();
        $testData = TestClient::getTestDataFor('/statuslog/latest');

        $i = 0;
        foreach ($statuses as $status) {
            $this->assertInstanceOf(Status::class, $status);
            $this->assertEquals($testData['response']['statuses'][$i]['id'], $status->id);
            $i++;
        }

        $this->assertCount(count($testData['response']['statuses']), $statuses);
    }
}