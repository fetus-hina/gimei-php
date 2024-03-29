<?php

namespace jp3cki\gimei\test\address;

use jp3cki\gimei\Exception;
use jp3cki\gimei\address\Dictionary;
use jp3cki\gimei\test\TestCase;

class DictionaryTest extends TestCase
{
    // 存在しないファイルを読もうとすると例外が飛ぶはず
    public function testNotFound(): void
    {
        $this->expectException(Exception::class);
        new Dictionary(__DIR__ . '/dictionary-test-not-exist.json');
    }

    // そもそも JSON ですらないファイルを読もうとすると例外が飛ぶはず
    public function testCompletelyBroken(): void
    {
        $this->expectException(Exception::class);
        new Dictionary(__DIR__ . '/dictionary-test-completely-broken.json');
    }

    // JSON としては正しいがデータファイルとしては壊れているものを
    // 読むと例外が飛ぶはず
    public function testBroken(): void
    {
        $this->expectException(Exception::class);
        new Dictionary(__DIR__ . '/dictionary-test-broken.json');
    }

    public function testGetOneOfPrefecture(): void
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfPrefecture();
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '東京都' || $ret[0] === '大阪府');
        }
    }

    public function testGetOneOfCity(): void
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfCity();
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '新宿区' || $ret[0] === '大阪市中央区');
        }
    }

    public function testGetOneOfTown(): void
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfTown();
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '西新宿' || $ret[0] === '大手前');
        }
    }
}
