<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\BaseController;

class FirstController extends BaseController
{
    public function home(Request $request, Response $response, $args)
    {
//        $request = $request->getQueryParams();
//        $postData = $request->getParsedBody();
//        $response->getBody()->write($this->container->get('my-service'));
//        $response->getBody()->write($this->container->get('settings')['db']['user']);

        $data = [
            ['name' => 'Adam', 'id' => 2],
            ['name' => 'John', 'id' => 4]
        ];
        $response = $this->container->get('view')->render(
            $response,
            'home.phtml',
            [
                'name' => $args['name'],
                'data' => $data
            ]
        );

        return $response;
    }
}