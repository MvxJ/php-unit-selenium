<?php

namespace tests\acceptance;

use PHPUnit\Extensions\Selenium2TestCase;

class FrontendStuffTest extends Selenium2TestCase
{
    public function setUp(): void
    {
        $this->setHost('http://172.19.160.1');
        $this->setPort(4444);
        $this->setBrowserUrl('http://localhost:8000');
        $this->setBrowser('chrome');
        $this->setDesiredCapabilities(['chromeOptions' => ['w3c' => false]]);
    }

    public function testCanSeeCorrectStringOnMainPage()
    {
        $this->url('/');

        $this->assertStringContainsString('Add a new category', $this->source());
    }

    public function testCanSeeConfirmDialogBoxWhenTryingDeleteCategory()
    {
        $this->url('show-category/1');
        $this->clickOnElement('delete-category-confirmation');
        $this->waitUntil(function () {
            if ($this->alertIsPresent()) return true;

            return false;
        }, 4000);

        $this->dismissAlert();
        $this->assertTrue(true);
    }

    /**
     * @skip
     */
    public function canSeeCorrectMessageAfterDeletingCategory()
    {
        $this->url('show-category/1');
        $this->clickOnElement('delete-category-confirmation');
        $this->waitUntil(function () {
            if ($this->alertIsPresent()) return true;

            return false;
        }, 4000);

        $this->acceptAlert();
        $this->assertStringContainsString('Category was deleted', $this->source());
        $this->markTestIncomplete('Should appear after deleting category.');
    }

    public function testCanSeeEditAndDetailLinksAndCategoryName()
    {
        $this->url('show-category/1');
        $electronics = $this->byLinkText('Electronics');
        $electronics->click();

        $h5 = $this->byCssSelector('div.basic-card-content h5');
        $this->assertStringContainsString('Electronics', $h5->text());

        $editLink = $this->byLinkText('Edit');
        $href = $editLink->attribute('href');
        $this->assertStringContainsString('edit-category/1', $href);

        $this->markTestIncomplete('Category name, description, edit detail links from fe');
    }

    public function testCanSeeEDitCategoryMessage()
    {
        $this->url('show-category/1');
        $editLink = $this->byLinkText('Edit');
        $editLink->click();

        $this->assertStringContainsString('Edit', $this->source());

        $this->markTestIncomplete('Currently not completed');
    }

    public function testCanSeeFormValidation()
    {
        $this->url('');
        $button = $this->byCssSelector('input[type="submit"]');
        $button->submit();

        $this->assertStringContainsString('Fill correctly the form', $this->source());
        $this->back();

        $categoryName = $this->byName('category_name');
        $categoryName->value('Name');

        $description = $this->byName('category_description');
        $description->value('Description');

        $button = $this->byCssSelector('input[type="submit"]');
        $button->submit();

        $this->assertStringContainsString('Category was saved', $this->source());

        $this->markTestIncomplete('Need to finish be');
    }

    public function canSeeNestedCategories()
    {
        $this->url('');
        $categories = $this->elements($this->using('css selector')->value('ul.dropdown li'));

        $this->assertCount(18, $categories);

        $element1 = $this->byCssSelector('ul.dropdown > li:nth-child(2) > a');
        $element2 = $this->byCssSelector('ul.dropdown > li:nth-child(3) > a');
        $element3 = $this->byCssSelector('ul.dropdown > li:nth-child(4) > a');
//        $element4 = $this->byCssSelector('ul.dropdown > :nth-child(2) > :nth-child(2) > :nth-child(1) > a');
        $element4 = $this->byXPath('//ul[@class="dropdown menu"]/l[2]/ul[1]/li[1]/a');

        $this->assertStringContainsString('Electronics', $element1->text());
        $this->assertStringContainsString('Videos', $element2->text());
        $this->assertStringContainsString('Software', $element3->text());
        $this->assertStringContainsString('Monitors', $element4->text());
    }
}