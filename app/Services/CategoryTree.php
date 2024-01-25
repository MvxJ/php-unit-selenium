<?php

namespace App\Services;

class CategoryTree
{
    protected $categoryList;

    public function convert(array $array, int $parentId = null): array
    {
        $nestedCategories = [];

        foreach ($array as $category) {
            $category['children'] = [];
            if ($category['parent_id'] == $parentId) {
                $children = $this->convert($array, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }

                $nestedCategories[] = $category;
            }
        }

        return $nestedCategories;
    }
}