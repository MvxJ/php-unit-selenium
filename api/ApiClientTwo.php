<?php

namespace Api;

class ApiClientTwo
{
    protected $httpClient;

    public function __construct($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getPostById(int $id)
    {
        return $this->httpClient->get('posts/' . $id);
    }

    public function addPost(array $post)
    {
        $postData = [
            'json' => $post
        ];

        return $this->httpClient->post('posts', $postData);
    }

    public function deletePost(int $id)
    {
        return $this->httpClient->delete('posts/' . $id);
    }

    public function updatePost($id, $patch)
    {
        $patchData = [
            'json' => $patch
        ];

        return $this->httpClient->patch('posts/' . $id, $patchData);
    }

    public function replacePost($id, $post)
    {
        $postData  = [
            'json' => $post
        ];

        return $this->httpClient->put('posts/' . $id, $postData);
    }
}