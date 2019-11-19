<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei\address;

use jp3cki\gimei\Exception;

/**
 * データを読み込みランダムに選択する
 */
class Factory
{
    /**
     * データファイルへの相対パス
     */
    private const JSON_REL_PATH = '../../data/addresses.json';
    
    /**
     * データファイルを保持する
     * @var Dictionary
     */
    private static $dictionary = null;

    /**
     * 住所をランダムに選択して返す
     *
     * @return Address
     */
    public static function generate()
    {
        if (self::$dictionary === null) {
            self::loadData();
        }

        $dict = self::$dictionary;
        return new Address(
            new AddressUnit($dict->getOneOfPrefecture()),
            new AddressUnit($dict->getOneOfCity()),
            new AddressUnit($dict->getOneOfTown())
        );
    }

    /**
     * データファイルを読み込む
     */
    private static function loadData()
    {
        $jsonPath = __DIR__ . '/' . self::JSON_REL_PATH;
        self::$dictionary = new Dictionary($jsonPath);
    }
}
