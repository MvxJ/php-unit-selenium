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

    public function editCategory(Request $request, Response $response, $args)
    {
        $categoryId = $args['id'];
        $category = ['name' => 'Electronics', 'parent' => null];
        $response = $this->container->get('view')->render(
            $response,
            'home.phtml',
            ['editedCategory' => $category]
        );

        return $response;
    }

    public function saveCategory(Request $request, Response $response, $args)
    {
        $data = $request->getParsedBody();

        if (empty($data['category_name']) || empty($data['category_name'])) {
            $categorySaved = false;
        } else {
            $categorySaved = true;
        }

        $response = $this->container->get('view')->render(
            $response,
            'home.phtml',
            ['categorySaved' => $categorySaved]
        );

        return $response;
    }
}