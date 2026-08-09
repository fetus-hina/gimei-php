<?php

namespace jp3cki\gimei\test\name;

use jp3cki\gimei\name\NameUnit;
use jp3cki\gimei\name\Person;
use jp3cki\gimei\test\TestCase;

class PersonTest extends TestCase
{
    private Person $male;

    private Person $female;

    protected function setUp(): void
    {
        $this->male = new Person(
            new NameUnit(['太郎', 'たろう', 'タロウ', 'Tarou']),
            new NameUnit(['山田', 'やまだ', 'ヤマダ', 'Yamada']),
            true
        );
        $this->female = new Person(
            new NameUnit(['陽菜', 'ひな', 'ヒナ', 'Hina']),
            new NameUnit(['相沢', 'あいざわ', 'アイザワ', 'Aizawa']),
            false
        );
    }

    protected function tearDown(): void
    {
        unset($this->male);
        unset($this->female);
    }

    public function testGetKanji(): void
    {
        $this->assertEquals('山田 太郎', $this->male->getKanji());
        $this->assertEquals('山田 太郎', $this->male->kanji);
        $this->assertEquals('相沢 陽菜', $this->female->getKanji());
        $this->assertEquals('相沢 陽菜', $this->female->kanji);
    }

    public function testGetHiragana(): void
    {
        $this->assertEquals('やまだ たろう', $this->male->getHiragana());
        $this->assertEquals('やまだ たろう', $this->male->hiragana);
        $this->assertEquals('あいざわ ひな', $this->female->getHiragana());
        $this->assertEquals('あいざわ ひな', $this->female->hiragana);
    }

    public function testGetKatakana(): void
    {
        $this->assertEquals('ヤマダ タロウ', $this->male->getKatakana());
        $this->assertEquals('ヤマダ タロウ', $this->male->katakana);
        $this->assertEquals('アイザワ ヒナ', $this->female->getKatakana());
        $this->assertEquals('アイザワ ヒナ', $this->female->katakana);
    }

    // 漢字・かな・カナと違い「名 姓」の順になる
    public function testGetRomaji(): void
    {
        $this->assertEquals('Tarou Yamada', $this->male->getRomaji());
        $this->assertEquals('Tarou Yamada', $this->male->romaji);
        $this->assertEquals('Hina Aizawa', $this->female->getRomaji());
        $this->assertEquals('Hina Aizawa', $this->female->romaji);
    }

    public function testIsMale(): void
    {
        $this->assertTrue($this->male->isMale());
        $this->assertTrue($this->male->isMale);
        $this->assertTrue($this->male->is_male);
        $this->assertFalse($this->female->isMale());
        $this->assertFalse($this->female->isMale);
        $this->assertFalse($this->female->is_male);
    }

    public function testIsFemale(): void
    {
        $this->assertFalse($this->male->isFemale());
        $this->assertFalse($this->male->isFemale);
        $this->assertFalse($this->male->is_female);
        $this->assertTrue($this->female->isFemale());
        $this->assertTrue($this->female->isFemale);
        $this->assertTrue($this->female->is_female);
    }

    public function testStringily(): void
    {
        $this->assertEquals($this->male->getKanji(), (string)$this->male);
        $this->assertEquals($this->female->getKanji(), (string)$this->female);
    }

    public function testFirstName(): void
    {
        $maleFirstName = $this->male->getFirstName();
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleFirstName);
        $this->assertEquals('太郎', $maleFirstName->getKanji());

        $maleFirstName = $this->male->firstName;
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleFirstName);
        $this->assertEquals('太郎', $maleFirstName->getKanji());

        $maleFirstName = $this->male->first_name;
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleFirstName);
        $this->assertEquals('太郎', $maleFirstName->getKanji());

        $maleFirstName = $this->male->first;
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleFirstName);
        $this->assertEquals('太郎', $maleFirstName->getKanji());
    }

    public function testLastName(): void
    {
        $maleLastName = $this->male->getLastName();
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleLastName);
        $this->assertEquals('山田', $maleLastName->getKanji());

        $maleLastName = $this->male->lastName;
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleLastName);
        $this->assertEquals('山田', $maleLastName->getKanji());

        $maleLastName = $this->male->last_name;
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleLastName);
        $this->assertEquals('山田', $maleLastName->getKanji());

        $maleLastName = $this->male->last;
        $this->assertInstanceOf('jp3cki\gimei\name\NameUnit', $maleLastName);
        $this->assertEquals('山田', $maleLastName->getKanji());
    }

    public function testUnknownProperty(): void
    {
        // @phpstan-ignore-next-line
        $this->assertNull($this->male->hoge);
    }
}
