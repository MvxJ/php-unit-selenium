<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function home(Request $request, Response $response, $args)
    {
//        $request = $request->getQueryParams();
//        $postData = $request->getParsedBody();
//        $response->getBody()->write($this->container->get('my-service'));
//        $response->getBody()->write($this->container->get('settings')['db']['user']);

        $response = $this->container->get('view')->render(
            $response,
            'home.phtml'
        );

        return $response;
    }
}