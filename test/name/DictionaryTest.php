<?php

namespace jp3cki\gimei\test\name;

use jp3cki\gimei\Exception;
use jp3cki\gimei\name\Dictionary;
use jp3cki\gimei\name\Gender;
use jp3cki\gimei\test\TestCase;

class DictionaryTest extends TestCase
{
    // 存在しないファイルを読もうとすると例外が飛ぶはず
    public function testNotFound()
    {
        $this->expectException(Exception::class);
        new Dictionary(__DIR__ . '/dictionary-test-not-exist.json');
    }

    // そもそも JSON ですらないファイルを読もうとすると例外が飛ぶはず
    public function testCompletelyBroken()
    {
        $this->expectException(Exception::class);
        new Dictionary(__DIR__ . '/dictionary-test-completely-broken.json');
    }

    // JSON としては正しいがデータファイルとしては壊れているものを
    // 読むと例外が飛ぶはず
    public function testBroken()
    {
        $this->expectException(Exception::class);
        new Dictionary(__DIR__ . '/dictionary-test-broken.json');
    }

    public function testGetOneOfFirstNameMale()
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfFirstName(Gender::MALE);
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '太郎' || $ret[0] === '次郎'); // 花子とか返ってきたらダメ
        }
    }

    public function testGetOneOfFirstNameFemale()
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfFirstName(Gender::FEMALE);
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '花子' || $ret[0] === '陽菜'); // 太郎とか返ってきたらダメ
        }
    }

    public function testGetOneOfFirstNameInvalid()
    {
        $this->expectException(Exception::class);
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        $dict->getOneOfFirstName('hoge');
    }

    public function testGetOneOfLastName()
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfLastName();
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '相沢' || $ret[0] === '鈴木');
        }
    }
}
