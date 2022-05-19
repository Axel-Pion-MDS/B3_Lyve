<?php

namespace App\Tests;

use App\Tests\Data\BadgeControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BadgeControllerTest extends KernelTestCase
{
    /**
     * @throws JsonException
     * @throws GuzzleException|JsonException
     */
    public function testAdd(): void
    {
        $badge = [
            'title' => 'UnitTest',
            'picture' => 'UnitTestPicture',
            'modules' => [],
            'users' => [],
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post('http://lyve.local/badge/add', [
            RequestOptions::JSON => $badge
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        BadgeControllerTestData::$badgeId = $data['badgeId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $client = new Client(['verify' => false]);
        $request = $client->get('http://lyve.local/badge/list');

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('picture', $data['data'][0]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testShow(): void
    {
        $id = BadgeControllerTestData::$badgeId;
        $client = new Client(['verify' => false]);
        $request = $client->get("http://lyve.local/badge/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('picture', $data['data'][0]);
        $this->assertArrayHasKey('modules', $data['data'][0]);
        $this->assertArrayHasKey('users', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $id = BadgeControllerTestData::$badgeId;
        $client = new Client(['verify' => false]);
        $user = [
            'id' => $id,
            'title' => 'UnitTestEdit',
            'picture' => 'UnitTestEditPicture',
            'modules' => [],
            'users' => [],
        ];
        $request = $client->patch('http://lyve.local/badge/edit', [
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
        $id = BadgeControllerTestData::$badgeId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("http://lyve.local/badge/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
