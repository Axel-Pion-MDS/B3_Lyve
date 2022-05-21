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
     * @throws JsonException
     * @throws GuzzleException|JsonException
     */
    public function testAdd(): void
    {
        $module = [
            'answer' => 'UnitTest',
            'isCorrect' => 1,
            'question' => 2,
            'users' => []
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post('https://lyve.local/answer/add', [
            RequestOptions::JSON => $module
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        AnswerControllerTestData::$answerId = $data['answerId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $client = new Client(['verify' => false]);
        $request = $client->get('https://lyve.local/answer/list');

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('answer', $data['data'][0]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testShow(): void
    {
        $id = AnswerControllerTestData::$answerId;
        $client = new Client(['verify' => false]);
        $request = $client->get("https://lyve.local/answer/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('answer', $data['data'][0]);
        $this->assertArrayHasKey('isCorrect', $data['data'][0]);
        $this->assertArrayHasKey('question', $data['data'][0]);
        $this->assertArrayHasKey('users', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $id = AnswerControllerTestData::$answerId;
        $client = new Client(['verify' => false]);
        $answer = [
            'id' => $id,
            'answer' => 'UnitTestEdit',
            'isCorrect' => 2,
            'question' => 2,
            'users' => [],
        ];
        $request = $client->patch('https://lyve.local/answer/edit', [
            RequestOptions::JSON => $answer
        ]);

        $this->assertJson(json_encode($answer, JSON_THROW_ON_ERROR));
        $this->assertEquals(200, $request->getStatusCode());
    }

    /**
     * @throws GuzzleException
     */
    public function testDelete(): void
    {
        $id = AnswerControllerTestData::$answerId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("https://lyve.local/answer/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
