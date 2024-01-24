<?php

class SeleniumTest extends PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowserUrl('http://wwww.google.com');
        $this->setBrowser('chrome');
    }

    public function testTitle()
    {
        $this->url();
        $this->assertEquals('Google', $this->title());
    }
}