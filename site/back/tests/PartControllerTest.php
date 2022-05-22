<?php

namespace App\Tests;

use App\Tests\Data\PartControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PartControllerTest extends KernelTestCase
{
    /**
     * @throws JsonException
     * @throws GuzzleException|JsonException
     */
    public function testAdd(): void
    {
        $module = [
            'title' => 'UnitTest',
            'content' => 'UnitTest',
            'chapter' => 1,
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post('https://lyve.local/part/add', [
            RequestOptions::JSON => $module
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        PartControllerTestData::$partId = $data['partId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $url = $_ENV['APP_URL'];
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/part/list");

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
        $id = PartControllerTestData::$partId;
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/part/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('content', $data['data'][0]);
        $this->assertArrayHasKey('chapter', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $url = $_ENV['APP_URL'];
        $id = PartControllerTestData::$partId;
        $client = new Client(['verify' => false]);
        $part = [
            'id' => $id,
            'title' => 'UnitTestEdit',
            'content' => 'UnitTestEdit',
            'chapter' => 1,
        ];
        $request = $client->patch("$url/part/edit", [
            RequestOptions::JSON => $part
        ]);

        $this->assertJson(json_encode($part, JSON_THROW_ON_ERROR));
        $this->assertEquals(200, $request->getStatusCode());
    }

    /**
     * @throws GuzzleException
     */
    public function testDelete(): void
    {
        $url = $_ENV['APP_URL'];
        $id = PartControllerTestData::$partId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("$url/part/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
