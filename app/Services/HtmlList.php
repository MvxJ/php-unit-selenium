<?php

namespace App\Services;

class HtmlList extends CategoryTree
{
    protected $htmlUlOpen = '<ul>';
    protected $htmlUlClose = '</ul>';
    protected  $htmlLiOpen = '<li>';
    protected  $htmlLiClose = '</li>';

    public function makeUlList($afterConversionArray): string
    {
        $this->categoryList .= $this->htmlUlOpen;

        foreach ($afterConversionArray as $value) {
            $this->categoryList .= $this->htmlLiOpen . $value['name'];

            if (!empty($value['children'])) {
                $this->makeUlList($value['children']);
            }

            $this->categoryList .= $this->htmlLiClose;
        }

        $this->categoryList .= $this->htmlUlClose;

        return $this->categoryList;
    }
}