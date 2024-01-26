<?php

namespace tests\unit;

use App\Services\CategoryTree;
use App\Services\ForSelectList;
use App\Services\HtmlList;
use PHPUnit\Framework\TestCase;

class CategoryTreeTest extends TestCase
{
    protected CategoryTree $tree;

    public function setUp(): void
    {
        $this->tree = new CategoryTree();
    }

    /**
     * @param $afterConversionArg
     * @param $dbResultArg
     * @return void
     * @dataProvider arrayProvider
     */
    public function testCanConvertDatabaseResultToCategoryTree($afterConversionArg, $dbResultArg): void
    {
        $this->assertSame($afterConversionArg, $this->tree->convert($dbResultArg));
    }

    /**
     * @param $afterConversionArg
     * @param $dbResultArg
     * @param $htmlList
     * @return void
     * @dataProvider arrayProvider
     */
    public function testCanGenerateHtmlForCategoryTree(
        array$afterConversionArg,
        array $dbResultArg,
        string $htmlList,
        array $selectList
    ): void {
        $html = new HtmlList();
        $htmlSelect = new ForSelectList();
        $afterConversion = $html->convert($dbResultArg);

        $this->assertEquals($htmlList, $html->makeUlList($afterConversion));
        $this->assertEquals($selectList, $htmlSelect->makeSelectList($afterConversion));
    }

    public function arrayProvider(): array
    {
        return [
            'one level' => [
                [
                    ['id' => 1, 'name' => 'Electronics', 'parent_id' => null, 'children' => []],
                    ['id' => 2, 'name' => 'Videos', 'parent_id' => null, 'children' => []],
                    ['id' => 3, 'name' => 'Software', 'parent_id' => null, 'children' => []]
                ],
                [
                    ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
                    ['id' => 2, 'name' => 'Videos', 'parent_id' => null],
                    ['id' => 3, 'name' => 'Software', 'parent_id' => null]
                ],
                '<ul><li>Electronics</li><li>Videos</li><li>Software</li></ul>',
                [
                    ['name' => 'Electronics', 'id' => 1],
                    ['name' => 'Videos', 'id' => 2],
                    ['name' => 'Software', 'id' => 3]
                ]
            ],
            'two level' => [
                [
                    [
                        'id' => 1,
                        'name' => 'Electronics',
                        'parent_id' => null,
                        'children' => [
                            ['id' => 2, 'name' => 'Computers', 'parent_id' => 1, 'children' => []]
                        ]
                    ]
                ],
                [
                    ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
                    ['id' => 2, 'name' => 'Computers', 'parent_id' => 1],
                ],
                '<ul><li>Electronics<ul><li>Computers</li></ul></li></ul>',
                [
                    ['name' => 'Electronics', 'id' => 1],
                    ['name' => '&nbsp;&nbsp;Computers', 'id' => 2]
                ]
            ],
            'three level' => [
                [
                    [
                        'id' => 1,
                        'name' => 'Electronics',
                        'parent_id' => null,
                        'children' => [
                            [
                                'id' => 2,
                                'name' => 'Computers',
                                'parent_id' => 1,
                                'children' => [
                                    [
                                        'id' => 3,
                                        'name' => 'Laptops',
                                        'parent_id' => 2,
                                        'children' => []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    ['id' => 1, 'name' => 'Electronics', 'parent_id' => null],
                    ['id' => 2, 'name' => 'Computers', 'parent_id' => 1],
                    ['id' => 3, 'name' => 'Laptops', 'parent_id' => 2],
                ],
                '<ul><li>Electronics<ul><li>Computers<ul><li>Laptops</li></ul></li></ul></li></ul>',
                [
                    ['name' => 'Electronics', 'id' => 1],
                    ['name' => '&nbsp;&nbsp;Computers', 'id' => 2],
                    ['name' => '&nbsp;&nbsp;&nbsp;&nbsp;Laptops', 'id' => 3],
                ]
            ]
        ];
    }
}