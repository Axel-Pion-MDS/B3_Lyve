<?php

namespace App\Tests;

use App\Tests\Data\UserControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserControllerTest extends KernelTestCase
{
    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testAdd(): void
    {
        $user = [
            'firstname' => 'UnitTest',
            'lastname' => 'UnitTest',
            'email' => 'unit.test@mail.com',
            'birthdate' => '2022-05-14',
            'number' => '0612345678',
            'role' => 1,
            'offer' => '',
            'badges' => [],
            'answers' => [],
        ];

        $client = new Client(['verify' => false]);
        $request = $client->post('https://lyve.local/user/add', [
            RequestOptions::JSON => $user
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        UserControllerTestData::$userId = $data['userId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $client = new Client(['verify' => false]);
        $request = $client->get('https://lyve.local/user/list');

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('firstname', $data['data'][0]);
        $this->assertArrayHasKey('lastname', $data['data'][0]);
        $this->assertArrayHasKey('email', $data['data'][0]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testShow(): void
    {
        $id = UserControllerTestData::$userId;
        $client = new Client(['verify' => false]);
        $request = $client->get("https://lyve.local/user/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('firstname', $data['data'][0]);
        $this->assertArrayHasKey('lastname', $data['data'][0]);
        $this->assertArrayHasKey('email', $data['data'][0]);
        $this->assertArrayHasKey('birthdate', $data['data'][0]);
        $this->assertArrayHasKey('number', $data['data'][0]);
        $this->assertArrayHasKey('role', $data['data'][0]);
        $this->assertArrayHasKey('offer', $data['data'][0]);
        $this->assertArrayHasKey('badges', $data['data'][0]);
        $this->assertArrayHasKey('answers', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $id = UserControllerTestData::$userId;
        $client = new Client(['verify' => false]);
        $user = [
            'id' => $id,
            'firstname' => 'UnitTestEdit',
            'lastname' => 'UnitTestEdit',
            'email' => 'unit.test@mail.com',
            'birthdate' => '2022-05-14',
            'number' => '0612345678',
            'role' => 1,
            'offer' => '',
            'badges' => [],
            'users' => [],
        ];
        $request = $client->patch('https://lyve.local/user/edit', [
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
        $id = UserControllerTestData::$userId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("https://lyve.local/user/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
