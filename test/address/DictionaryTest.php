<?php
namespace jp3cki\gimei\test\address;

use jp3cki\gimei\address\Dictionary;
use jp3cki\gimei\test\TestCase;

class DictionaryTest extends TestCase
{
    // 存在しないファイルを読もうとすると例外が飛ぶはず
    public function testNotFound()
    {
        $this->setExpectedException('jp3cki\gimei\Exception');
        new Dictionary(__DIR__ . '/dictionary-test-not-exist.json');
    }

    // そもそも JSON ですらないファイルを読もうとすると例外が飛ぶはず
    public function testCompletelyBroken()
    {
        $this->setExpectedException('jp3cki\gimei\Exception');
        new Dictionary(__DIR__ . '/dictionary-test-completely-broken.json');
    }

    // JSON としては正しいがデータファイルとしては壊れているものを
    // 読むと例外が飛ぶはず
    public function testBroken()
    {
        $this->setExpectedException('jp3cki\gimei\Exception');
        new Dictionary(__DIR__ . '/dictionary-test-broken.json');
    }

    public function testGetOneOfPrefecture()
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfPrefecture();
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '東京都' || $ret[0] === '大阪府');
        }
    }

    public function testGetOneOfCity()
    {
        $dict = new Dictionary(__DIR__ . '/dictionary-test-valid.json');
        foreach (range(1, 20) as $i) {
            $ret = $dict->getOneOfCity();
            $this->assertTrue(is_array($ret));
            $this->assertTrue(count($ret) === 3);
            $this->assertTrue($ret[0] === '新宿区' || $ret[0] === '大阪市中央区');
        }
    }

    public function testGetOneOfTown()
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
