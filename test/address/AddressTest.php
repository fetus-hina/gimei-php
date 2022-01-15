<?php

namespace jp3cki\gimei\test\address;

use jp3cki\gimei\address\AddressUnit;
use jp3cki\gimei\address\Address;
use jp3cki\gimei\test\TestCase;

class AddressTest extends TestCase
{
    /** @var Address */
    private $osaka;

    /** @var Address */
    private $tokyo;

    /** @return void */
    public function setUp()
    {
        $this->osaka = new Address(
            new AddressUnit(
                ['大阪府', 'おおさかふ', 'オオサカフ']
            ),
            new AddressUnit(
                ['大阪市中央区', 'おおさかしちゅうおうく', 'オオサカシチュウオウク']
            ),
            new AddressUnit(
                ['大手前', 'おおてまえ', 'オオテマエ']
            )
        );
        $this->tokyo = new Address(
            new AddressUnit(
                ['東京都', 'とうきょうと', 'トウキョウト']
            ),
            new AddressUnit(
                ['新宿区', 'しんじゅくく', 'シンジュクク']
            ),
            new AddressUnit(
                ['西新宿', 'にししんじゅく', 'ニシシンジュク']
            )
        );
    }

    /** @return void */
    public function tearDown()
    {
        unset($this->osaka);
        unset($this->tokyo);
    }

    public function testGetKanji(): void
    {
        $this->assertEquals(
            '大阪府大阪市中央区大手前',
            $this->osaka->getKanji()
        );
        $this->assertEquals(
            '大阪府大阪市中央区大手前',
            $this->osaka->kanji
        );
        $this->assertEquals(
            '東京都新宿区西新宿',
            $this->tokyo->getKanji()
        );
        $this->assertEquals(
            '東京都新宿区西新宿',
            $this->tokyo->kanji
        );
    }

    public function testGetHiragana(): void
    {
        $this->assertEquals(
            'おおさかふおおさかしちゅうおうくおおてまえ',
            $this->osaka->getHiragana()
        );
        $this->assertEquals(
            'おおさかふおおさかしちゅうおうくおおてまえ',
            $this->osaka->hiragana
        );
        $this->assertEquals(
            'とうきょうとしんじゅくくにししんじゅく',
            $this->tokyo->getHiragana()
        );
        $this->assertEquals(
            'とうきょうとしんじゅくくにししんじゅく',
            $this->tokyo->hiragana
        );
    }

    public function testGetKatakana(): void
    {
        $this->assertEquals(
            'オオサカフオオサカシチュウオウクオオテマエ',
            $this->osaka->getKatakana()
        );
        $this->assertEquals(
            'オオサカフオオサカシチュウオウクオオテマエ',
            $this->osaka->katakana
        );
        $this->assertEquals(
            'トウキョウトシンジュククニシシンジュク',
            $this->tokyo->getKatakana()
        );
        $this->assertEquals(
            'トウキョウトシンジュククニシシンジュク',
            $this->tokyo->katakana
        );
    }

    public function testStringily(): void
    {
        $this->assertEquals($this->osaka->getKanji(), (string)$this->osaka);
        $this->assertEquals($this->tokyo->getKanji(), (string)$this->tokyo);
    }

    public function testPrefecture(): void
    {
        $o = $this->osaka->getPrefecture();
        $this->assertInstanceOf('jp3cki\gimei\address\AddressUnit', $o);
        $this->assertEquals('大阪府', $o->getKanji());

        $o = $this->osaka->prefecture;
        $this->assertInstanceOf('jp3cki\gimei\address\AddressUnit', $o);
        $this->assertEquals('大阪府', $o->getKanji());
    }

    public function testCity(): void
    {
        $o = $this->osaka->getCity();
        $this->assertInstanceOf('jp3cki\gimei\address\AddressUnit', $o);
        $this->assertEquals('大阪市中央区', $o->getKanji());

        $o = $this->osaka->city;
        $this->assertInstanceOf('jp3cki\gimei\address\AddressUnit', $o);
        $this->assertEquals('大阪市中央区', $o->getKanji());
    }

    public function testTown(): void
    {
        $o = $this->osaka->getTown();
        $this->assertInstanceOf('jp3cki\gimei\address\AddressUnit', $o);
        $this->assertEquals('大手前', $o->getKanji());

        $o = $this->osaka->town;
        $this->assertInstanceOf('jp3cki\gimei\address\AddressUnit', $o);
        $this->assertEquals('大手前', $o->getKanji());
    }

    public function testUnknownProperty(): void
    {
        // @phpstan-ignore-next-line
        $this->assertNull($this->osaka->hoge);
    }
}
