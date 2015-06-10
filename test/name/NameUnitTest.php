<?php
namespace jp3cki\gimei\test\name;

use jp3cki\gimei\name\NameUnit;
use jp3cki\gimei\test\TestCase;

class NameUnitTest extends TestCase
{
    private $obj1;
    private $obj2;

    public function setUp()
    {
        $this->obj1 = new NameUnit([ '山田', 'やまだ', 'ヤマダ' ]);
        $this->obj2 = new NameUnit([ '太郎', 'たろう', 'タロウ' ]);
    }

    public function tearDown()
    {
        unset($this->obj1);
        unset($this->obj2);
    }

    public function testGetKanji()
    {
        $this->assertEquals('山田', $this->obj1->getKanji());
        $this->assertEquals('山田', $this->obj1->kanji);
        $this->assertEquals('太郎', $this->obj2->getKanji());
        $this->assertEquals('太郎', $this->obj2->kanji);
    }

    public function testGetHiragana()
    {
        $this->assertEquals('やまだ', $this->obj1->getHiragana());
        $this->assertEquals('やまだ', $this->obj1->hiragana);
        $this->assertEquals('たろう', $this->obj2->getHiragana());
        $this->assertEquals('たろう', $this->obj2->hiragana);
    }

    public function testGetKatakana()
    {
        $this->assertEquals('ヤマダ', $this->obj1->getKatakana());
        $this->assertEquals('ヤマダ', $this->obj1->katakana);
        $this->assertEquals('タロウ', $this->obj2->getKatakana());
        $this->assertEquals('タロウ', $this->obj2->katakana);
    }

    public function testStringify()
    {
        $this->assertEquals($this->obj1->getKanji(), (string)$this->obj1);
        $this->assertEquals($this->obj2->getKanji(), (string)$this->obj2);
    }

    public function testUnknownProperty()
    {
        $this->assertNull($this->obj1->hoge);
    }
}
