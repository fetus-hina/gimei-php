<?php

namespace jp3cki\gimei\test\address;

use jp3cki\gimei\address\AddressUnit;
use jp3cki\gimei\test\TestCase;

class NameUnitTest extends TestCase
{
    /** @var AddressUnit */
    private $obj1;

    /** @var AddressUnit */
    private $obj2;

    /** @return void */
    public function setUp()
    {
        $this->obj1 = new AddressUnit([ '東京都', 'とうきょうと', 'トウキョウト' ]);
        $this->obj2 = new AddressUnit([ '大阪府', 'おおさかふ', 'オオサカフ' ]);
    }

    /** @return void */
    public function tearDown()
    {
        unset($this->obj1);
        unset($this->obj2);
    }

    public function testGetKanji(): void
    {
        $this->assertEquals('東京都', $this->obj1->getKanji());
        $this->assertEquals('東京都', $this->obj1->kanji);
        $this->assertEquals('大阪府', $this->obj2->getKanji());
        $this->assertEquals('大阪府', $this->obj2->kanji);
    }

    public function testGetHiragana(): void
    {
        $this->assertEquals('とうきょうと', $this->obj1->getHiragana());
        $this->assertEquals('とうきょうと', $this->obj1->hiragana);
        $this->assertEquals('おおさかふ', $this->obj2->getHiragana());
        $this->assertEquals('おおさかふ', $this->obj2->hiragana);
    }

    public function testGetKatakana(): void
    {
        $this->assertEquals('トウキョウト', $this->obj1->getKatakana());
        $this->assertEquals('トウキョウト', $this->obj1->katakana);
        $this->assertEquals('オオサカフ', $this->obj2->getKatakana());
        $this->assertEquals('オオサカフ', $this->obj2->katakana);
    }

    public function testStringify(): void
    {
        $this->assertEquals($this->obj1->getKanji(), (string)$this->obj1);
        $this->assertEquals($this->obj2->getKanji(), (string)$this->obj2);
    }

    public function testUnknownProperty(): void
    {
        // @phpstan-ignore-next-line
        $this->assertNull($this->obj1->hoge);
    }
}
