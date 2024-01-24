<?php

namespace Tests;

use Api\ApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    protected $httpClient;
    protected $apiClient;
    protected $mockHandler;

    public function setUp(): void
    {
//        $this->httpClient = new Client(['base_uri' => 'https://api.postcodes.io/']);
        $this->mockHandler = new MockHandler();
        $this->httpClient = new Client(['handler' => $this->mockHandler]);
        $this->apiClient = new ApiClient($this->httpClient);
    }

    public function tearDown(): void
    {
        unset($this->httpClient);
        unset($this->apiClient);
        unset($this->mockHandler);
    }

    public function testShowPostCodeData()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__ . '/fixtures/postcode.json')));
        $response = $this->apiClient->getPostCodeData('OX49 5NU');
        $data = json_decode($response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('admin_district', $data['result']);
    }

    public function testShowManyPostCodesData()
    {
        $this->mockHandler->append(new Response(200, [], file_get_contents(__DIR__ . '/fixtures/postcodes.json')));
        $response = $this->apiClient->getPostCodesData(["OX49 5NU", "M32 0JG", "NE30 1DP"]);
        $data = json_decode($response->getBody(), true);

        $this->assertCount(3, $data['result']);
    }
}