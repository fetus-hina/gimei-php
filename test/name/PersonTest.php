<?php
namespace jp3cki\gimei\test\name;

use jp3cki\gimei\name\NameUnit;
use jp3cki\gimei\name\Person;
use jp3cki\gimei\test\TestCase;

class PersonTest extends TestCase
{
    private $male;
    private $female;

    public function setUp()
    {
        $this->male = new Person(
            new NameUnit(['太郎', 'たろう', 'タロウ']),
            new NameUnit(['山田', 'やまだ', 'ヤマダ']),
            true
        );
        $this->female = new Person(
            new NameUnit(['陽菜', 'ひな', 'ヒナ']),
            new NameUnit(['相沢', 'あいざわ', 'アイザワ']),
            false
        );
    }

    public function tearDown()
    {
        unset($this->male);
        unset($this->female);
    }

    public function testGetKanji()
    {
        $this->assertEquals('山田 太郎', $this->male->getKanji());
        $this->assertEquals('山田 太郎', $this->male->kanji);
        $this->assertEquals('相沢 陽菜', $this->female->getKanji());
        $this->assertEquals('相沢 陽菜', $this->female->kanji);
    }

    public function testGetHiragana()
    {
        $this->assertEquals('やまだ たろう', $this->male->getHiragana());
        $this->assertEquals('やまだ たろう', $this->male->hiragana);
        $this->assertEquals('あいざわ ひな', $this->female->getHiragana());
        $this->assertEquals('あいざわ ひな', $this->female->hiragana);
    }

    public function testGetKatakana()
    {
        $this->assertEquals('ヤマダ タロウ', $this->male->getKatakana());
        $this->assertEquals('ヤマダ タロウ', $this->male->katakana);
        $this->assertEquals('アイザワ ヒナ', $this->female->getKatakana());
        $this->assertEquals('アイザワ ヒナ', $this->female->katakana);
    }

    public function testIsMale()
    {
        $this->assertTrue($this->male->isMale());
        $this->assertTrue($this->male->isMale);
        $this->assertTrue($this->male->is_male);
        $this->assertFalse($this->female->isMale());
        $this->assertFalse($this->female->isMale);
        $this->assertFalse($this->female->is_male);
    }

    public function testIsFemale()
    {
        $this->assertFalse($this->male->isFemale());
        $this->assertFalse($this->male->isFemale);
        $this->assertFalse($this->male->is_female);
        $this->assertTrue($this->female->isFemale());
        $this->assertTrue($this->female->isFemale);
        $this->assertTrue($this->female->is_female);
    }

    public function testStringily()
    {
        $this->assertEquals($this->male->getKanji(), (string)$this->male);
        $this->assertEquals($this->female->getKanji(), (string)$this->female);
    }

    public function testFirstName()
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

    public function testLastName()
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

    public function testUnknownProperty()
    {
        $this->assertNull($this->male->hoge);
    }
}
