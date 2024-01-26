<?php

namespace App\Services;

class HtmlList extends CategoryTree
{
    public function makeUlList($afterConversionArray): string
    {
        foreach ($afterConversionArray as $value) {
            $this->categoryList .= "<li><a href='htpp://localhost:8000/show-category/". $value['id'] . ',' . $value['name'] . "'>" . $value['name'] . "</a>";

            if (!empty($value['children'])) {
                $this->categoryList .= "<ul class='sumbenu menu vertical' data-submenu>";
                $this->makeUlList($value['children']);
                $this->categoryList .= '</ul>';
            }

            $this->categoryList .= "</li>";
        }

        return $this->categoryList;
    }
}