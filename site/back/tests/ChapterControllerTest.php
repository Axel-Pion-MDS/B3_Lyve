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
        $module = [
            'title' => 'UnitTest',
            'content' => 'UnitTest',
            'module' => 1,
            'parts' => [1],
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post('https://lyve.local/chapter/add', [
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
        $client = new Client(['verify' => false]);
        $request = $client->get('https://lyve.local/chapter/list');

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
        $id = ChapterControllerTestData::$chapterId;
        $client = new Client(['verify' => false]);
        $request = $client->get("https://lyve.local/chapter/show?id=$id");

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
        $id = ChapterControllerTestData::$chapterId;
        $client = new Client(['verify' => false]);
        $chapter = [
            'id' => $id,
            'title' => 'UnitTestEdit',
            'content' => 'UnitTestEdit',
            'module' => 1,
            'parts' => [1],
        ];
        $request = $client->patch('https://lyve.local/chapter/edit', [
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
        $id = ChapterControllerTestData::$chapterId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("https://lyve.local/chapter/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
