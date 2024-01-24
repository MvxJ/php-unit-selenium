<?php

namespace Api;

class ApiClient
{
    protected $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getPostCodeData(string $postCode)
    {
        return $this->httpClient->get('postcodes/' . $postCode);
    }

    public function getPostCodesData(array $postcodes)
    {
        return $this->httpClient->post('/postcodes', ['json' => ['postcodes' => $postcodes]]);
    }
}