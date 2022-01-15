<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
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
    private const JSON_REL_PATH = '../../data/names.json';

    /**
     * データファイルを保持する
     * @var Dictionary
     */
    private static $dictionary = null;

    /**
     * 名前をランダムに選択して返す
     *
     * @param mixed $maleRate 男性名が生成される確率(0.0～1.0)
     * @return Person
     */
    public static function generate($maleRate = 0.5)
    {
        if (self::$dictionary === null) {
            self::loadData();
        }
        switch (true) {
            // Gender::* is obsoluted in v1.1.0
            case $maleRate === Gender::MALE:
                $gender = Gender::MALE;
                break;

            case $maleRate === Gender::FEMALE:
                $gender = Gender::FEMALE;
                break;

            case $maleRate === Gender::BOTH:
            case !is_float($maleRate):
                $maleRate = 0.5;
                // fall through
            default:
                $gender = (mt_rand() / mt_getrandmax() <= $maleRate)
                    ? Gender::MALE
                    : Gender::FEMALE;
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
