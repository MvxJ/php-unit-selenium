<?php

namespace App\Services;

use App\Models\Category;

class CategoryFactory
{
    public static function create(): array
    {
        $categories = Category::all()->toArray();
        $htmlList = new HtmlList();
        $forSelectList = new ForSelectList();
        $convertedArray = $htmlList->convert($categories);
    
        return [
            'categories' => $htmlList->makeUlList($convertedArray),
            'selectListCategories' => $forSelectList->makeSelectList($convertedArray)
        ];
    }
}