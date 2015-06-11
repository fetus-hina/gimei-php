<?php
/**
 * @author AIZAWA Hina <hina@bouhime.com>
 * @copyright 2015 AIZAWA Hina <hina@bouhime.com>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei\name;

use jp3cki\gimei\Exception;

/**
 * データを読み込みランダムに選択する
 */
class Factory
{
    /**
     * データファイルへの相対パス
     */
    const JSON_REL_PATH = '../../data/names.json';
    
    /**
     * データファイルを保持する
     * @var Dictionary
     */
    private static $dictionary = null;

    /**
     * 名前をランダムに選択して返す
     *
     * @param mixed $geneder Gender::MALE|FEMALE|BOTH 選択する性
     * @return Person
     */
    public static function generate($gender = Gender::BOTH)
    {
        if (self::$dictionary === null) {
            self::loadData();
        }
        if ($gender !== Gender::MALE && $gender !== Gender::FEMALE) {
            $gender = (mt_rand() % 2 === 0) ? Gender::MALE : Gender::FEMALE;
        }

        $dict = self::$dictionary;

        return new Person(
            new NameUnit($dict->getOneOfFirstName($gender)),
            new NameUnit($dict->getOneOfLastName()),
            $gender === Gender::MALE
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
