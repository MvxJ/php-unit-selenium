<?php

namespace Tests;

use Api\ApiClientTwo;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class ApiClientTwoTest extends TestCase
{
    protected  $guzzleClient;
    protected $apiClient;

    public function setUp(): void
    {
        $this->guzzleClient = new Client(['base_uri' => 'http://localhost:3000/']);
        $this->apiClient = new ApiClientTwo($this->guzzleClient);
    }

    public function tearDown(): void
    {
        unset($this->guzzleClient);
        unset($this->apiClient);
    }

    public function testGetPostById()
    {
        $response = $this->apiClient->getPostById(1);
        $data = json_decode($response->getBody(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('title', $data);
    }

    public function testAddPost()
    {
        $this->apiClient->addPost(['id' => "3", 'title' => 'Example post', 'author' => 'John Doe']);
        $response = $this->apiClient->getPostById(3);
        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('title', $data);
        $this->assertEquals('Example post', $data['title']);
    }

    /**
     * @depends testAddPost
     */
    public function testDeletePost()
    {
        $response = $this->apiClient->deletePost(3);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdatePost()
    {
        $this->apiClient->updatePost(1, ['title' => 'New title for post']);
        $response = $this->apiClient->getPostById(1);
        $data = json_decode($response->getBody(), true);

        $this->assertEquals('New title for post', $data['title']);
    }

    public function testReplacePost()
    {
        $this->apiClient->updatePost(1, ['id' => "1", 'title' => 'Replaced post by test', 'author' => 'John Doe']);
        $response = $this->apiClient->getPostById(1);
        $data = json_decode($response->getBody(), true);

        $this->assertEquals('Replaced post by test', $data['title']);
    }
}