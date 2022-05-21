<?php

namespace App\Tests;

use App\Tests\Data\QuestionControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class QuestionControllerTest extends KernelTestCase
{
    /**
     * @throws JsonException
     * @throws GuzzleException|JsonException
     */
    public function testAdd(): void
    {
        $module = [
            'question' => 'UnitTest ?',
            'part' => 1,
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post('https://lyve.local/question/add', [
            RequestOptions::JSON => $module
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        QuestionControllerTestData::$questionId = $data['questionId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $client = new Client(['verify' => false]);
        $request = $client->get('https://lyve.local/question/list');

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('question', $data['data'][0]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testShow(): void
    {
        $id = QuestionControllerTestData::$questionId;
        $client = new Client(['verify' => false]);
        $request = $client->get("https://lyve.local/question/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('question', $data['data'][0]);
        $this->assertArrayHasKey('part', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $id = QuestionControllerTestData::$questionId;
        $client = new Client(['verify' => false]);
        $question = [
            'id' => $id,
            'question' => 'UnitTestEdit ?',
            'part' => 1,
        ];
        $request = $client->patch('https://lyve.local/question/edit', [
            RequestOptions::JSON => $question
        ]);

        $this->assertJson(json_encode($question, JSON_THROW_ON_ERROR));
        $this->assertEquals(200, $request->getStatusCode());
    }

    /**
     * @throws GuzzleException
     */
    public function testDelete(): void
    {
        $id = QuestionControllerTestData::$questionId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("https://lyve.local/question/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
