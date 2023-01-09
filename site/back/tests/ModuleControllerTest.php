<?php

namespace App\Tests;

use App\Tests\Data\ModuleControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ModuleControllerTest extends KernelTestCase
{
    /**
     * @throws JsonException
     * @throws GuzzleException|JsonException
     */
    public function testAdd(): void
    {
        $url = $_ENV['APP_URL'];
        $module = [
            'title' => 'UnitTest',
            'content' => 'UnitTest',
            'offers' => [],
            'badges' => [],
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post("$url/module/add", [
            RequestOptions::JSON => $module
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        ModuleControllerTestData::$moduleId = $data['moduleId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $url = $_ENV['APP_URL'];
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/module/list");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('content', $data['data'][0]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testShow(): void
    {
        $url = $_ENV['APP_URL'];
        $id = ModuleControllerTestData::$moduleId;
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/module/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('content', $data['data'][0]);
        $this->assertArrayHasKey('offers', $data['data'][0]);
        $this->assertArrayHasKey('badges', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $url = $_ENV['APP_URL'];
        $id = ModuleControllerTestData::$moduleId;
        $client = new Client(['verify' => false]);
        $user = [
            'id' => $id,
            'title' => 'UnitTestEdit',
            'content' => 'UnitTestEdit',
            'offers' => [],
            'badges' => [],
        ];
        $request = $client->patch("$url/module/edit", [
            RequestOptions::JSON => $user
        ]);

        $this->assertJson(json_encode($user, JSON_THROW_ON_ERROR));
        $this->assertEquals(200, $request->getStatusCode());
    }

    /**
     * @throws GuzzleException
     */
    public function testDelete(): void
    {
        $url = $_ENV['APP_URL'];
        $id = ModuleControllerTestData::$moduleId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("$url/module/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
