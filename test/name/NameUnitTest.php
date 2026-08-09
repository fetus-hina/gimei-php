<?php

namespace jp3cki\gimei\test\name;

use jp3cki\gimei\name\NameUnit;
use jp3cki\gimei\test\TestCase;

class NameUnitTest extends TestCase
{
    private NameUnit $obj1;

    private NameUnit $obj2;

    protected function setUp(): void
    {
        $this->obj1 = new NameUnit([ '山田', 'やまだ', 'ヤマダ', 'Yamada' ]);
        $this->obj2 = new NameUnit([ '太郎', 'たろう', 'タロウ', 'Tarou' ]);
    }

    protected function tearDown(): void
    {
        unset($this->obj1);
        unset($this->obj2);
    }

    public function testGetKanji(): void
    {
        $this->assertEquals('山田', $this->obj1->getKanji());
        $this->assertEquals('山田', $this->obj1->kanji);
        $this->assertEquals('太郎', $this->obj2->getKanji());
        $this->assertEquals('太郎', $this->obj2->kanji);
    }

    public function testGetHiragana(): void
    {
        $this->assertEquals('やまだ', $this->obj1->getHiragana());
        $this->assertEquals('やまだ', $this->obj1->hiragana);
        $this->assertEquals('たろう', $this->obj2->getHiragana());
        $this->assertEquals('たろう', $this->obj2->hiragana);
    }

    public function testGetKatakana(): void
    {
        $this->assertEquals('ヤマダ', $this->obj1->getKatakana());
        $this->assertEquals('ヤマダ', $this->obj1->katakana);
        $this->assertEquals('タロウ', $this->obj2->getKatakana());
        $this->assertEquals('タロウ', $this->obj2->katakana);
    }

    public function testGetRomaji(): void
    {
        $this->assertEquals('Yamada', $this->obj1->getRomaji());
        $this->assertEquals('Yamada', $this->obj1->romaji);
        $this->assertEquals('Tarou', $this->obj2->getRomaji());
        $this->assertEquals('Tarou', $this->obj2->romaji);
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
