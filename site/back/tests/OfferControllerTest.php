<?php

namespace App\Tests;

use App\Tests\Data\OfferControllerTestData;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OfferControllerTest extends KernelTestCase
{
    /**
     * @throws JsonException
     * @throws GuzzleException|JsonException
     */
    public function testAdd(): void
    {
        $url = $_ENV['APP_URL'];
        $offer = [
            'title' => 'UnitTest',
            'price' => 999,
            'modules' => [],
        ];
        $client = new Client(['verify' => false]);
        $request = $client->post("$url/offer/add", [
            RequestOptions::JSON => $offer
        ]);

        $this->assertJson(json_encode($request, JSON_THROW_ON_ERROR));
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals(200, $request->getStatusCode());
        $this->assertEquals('success', $data['result']);
        OfferControllerTestData::$offerId = $data['offerId'];
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testList(): void
    {
        $url = $_ENV['APP_URL'];
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/offer/list");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('price', $data['data'][0]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function testShow(): void
    {
        $url = $_ENV['APP_URL'];
        $id = OfferControllerTestData::$offerId;
        $client = new Client(['verify' => false]);
        $request = $client->get("$url/offer/show?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
        $data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertArrayHasKey('id', $data['data'][0]);
        $this->assertArrayHasKey('title', $data['data'][0]);
        $this->assertArrayHasKey('price', $data['data'][0]);
        $this->assertArrayHasKey('modules', $data['data'][0]);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function testEdit(): void
    {
        $url = $_ENV['APP_URL'];
        $id = OfferControllerTestData::$offerId;
        $client = new Client(['verify' => false]);
        $user = [
            'id' => $id,
            'title' => 'UnitTestEdit',
            'price' => 999,
            'modules' => [],
        ];
        $request = $client->patch("$url/offer/edit", [
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
        $id = OfferControllerTestData::$offerId;
        $client = new Client(['verify' => false]);
        $request = $client->delete("$url/offer/delete?id=$id");

        $this->assertEquals(200, $request->getStatusCode());
    }
}
