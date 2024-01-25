<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CategoryController extends BaseController
{
    public function deleteCategory(Request $request, Response $response, $args)
    {
        $categoryId = $args['id'];
        $response = $this->container->get('view')->render(
            $response,
            'home.phtml',
            ['categoryDeleted' => true]
        );

        return $response;
    }

    public function showCategory(Request $request, Response $response, $args)
    {
        $categoryId = $args['id'];
        $categoryName = 'Electronics';
        $response = $this->container->get('view')->render(
            $response,
            'home.phtml',
            ['categoryName' => $categoryName]
        );

        return $response;
    }
}