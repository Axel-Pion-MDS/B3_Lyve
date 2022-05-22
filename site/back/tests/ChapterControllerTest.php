<?php

namespace App\Tests;

use App\Tests\Data\ChapterControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ChapterControllerTest extends KernelTestCase
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
            'module' => 1,
            'parts' => [],
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post("$url/chapter/add", [
            RequestOptions::JSON => $module
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        ChapterControllerTestData::$chapterId = $data['chapterId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $url = $_ENV['APP_URL'];
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/chapter/list");

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
        $id = ChapterControllerTestData::$chapterId;
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/chapter/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('content', $data['data'][0]);
        $this->assertArrayHasKey('module', $data['data'][0]);
        $this->assertArrayHasKey('parts', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $url = $_ENV['APP_URL'];
        $id = ChapterControllerTestData::$chapterId;
        $client = new Client(['verify' => false]);
        $chapter = [
            'id' => $id,
            'title' => 'UnitTestEdit',
            'content' => 'UnitTestEdit',
            'module' => 1,
            'parts' => [],
        ];
        $request = $client->patch("$url/chapter/edit", [
            RequestOptions::JSON => $chapter
        ]);

        $this->assertJson(json_encode($chapter, JSON_THROW_ON_ERROR));
        $this->assertEquals(200, $request->getStatusCode());
    }

    /**
     * @throws GuzzleException
     */
    public function testDelete(): void
    {
        $url = $_ENV['APP_URL'];
        $id = ChapterControllerTestData::$chapterId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("$url/chapter/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
