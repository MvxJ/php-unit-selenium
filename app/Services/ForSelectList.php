<?php

namespace App\Services;

class ForSelectList extends CategoryTree
{
    public function makeSelectList(array $convertedArray, int $repeat = 0): array
    {

        foreach ($convertedArray as $category) {
            $this->categoryList[] = ['name' => str_repeat("&nbsp;", $repeat) . $category['name']];

            if (!empty($category['children'])) {
                $repeat += 2;
                $this->makeSelectList($category['children'], $repeat);
            }
        }

        return $this->categoryList;
    }
}