<?php

namespace App\Tests;

use App\Tests\Data\AnswerControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AnswerControllerTest extends KernelTestCase
{
    /**
     * Test answer controller's add method
     *
     * @throws JsonException
     * @throws GuzzleException|JsonException
     */
    public function testAdd(): void
    {
        $url = $_ENV['APP_URL'];
        $module = [
            'answer' => 'UnitTest',
            'isCorrect' => 1,
            'question' => 2,
            'users' => []
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post("$url/answer/add", [
            RequestOptions::JSON => $module
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        AnswerControllerTestData::$answerId = $data['answerId'];
    }

    /**
     * Test answer controller's list method
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $url = $_ENV['APP_URL'];
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/answer/list");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('answer', $data['data'][0]);
    }

    /**
     * Test answer controller's show method
     *
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testShow(): void
    {
        $url = $_ENV['APP_URL'];
        $id = AnswerControllerTestData::$answerId;
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/answer/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('answer', $data['data'][0]);
        $this->assertArrayHasKey('isCorrect', $data['data'][0]);
        $this->assertArrayHasKey('question', $data['data'][0]);
        $this->assertArrayHasKey('users', $data['data'][0]);
    }

    /**
     * Test answer controller's edit method
     *
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $url = $_ENV['APP_URL'];
        $id = AnswerControllerTestData::$answerId;
        $client = new Client(['verify' => false]);
        $answer = [
            'id' => $id,
            'answer' => 'UnitTestEdit',
            'isCorrect' => 2,
            'question' => 2,
            'users' => [],
        ];
        $request = $client->patch("$url/answer/edit", [
            RequestOptions::JSON => $answer
        ]);

        $this->assertJson(json_encode($answer, JSON_THROW_ON_ERROR));
        $this->assertEquals(200, $request->getStatusCode());
    }

    /**
     * Test answer controller's delete method
     *
     * @throws GuzzleException
     */
    public function testDelete(): void
    {
        $url = $_ENV['APP_URL'];
        $id = AnswerControllerTestData::$answerId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("$url/answer/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
