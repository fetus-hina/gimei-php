<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei;

use jp3cki\gimei\name\Gender;
use jp3cki\gimei\name\Factory as NameFactory;
use jp3cki\gimei\address\Factory as AddressFactory;

/**
 * gimei 外部インタフェースクラス
 */
class Gimei
{
    /**
     * 男女いずれかの名前をランダムに生成
     *
     * @param float $maleRate 男性名が生成される確率(0.0～1.0)
     * @return jp3cki\gimei\name\Person
     */
    public static function generateName($maleRate = 0.5)
    {
        return NameFactory::generate($maleRate);
    }

    /**
     * 男性名をランダムに生成
     *
     * @return jp3cki\gimei\name\Person
     */
    public static function generateMale()
    {
        return NameFactory::generate(1.0);
    }

    /**
     * 女性名をランダムに生成
     *
     * @return jp3cki\gimei\name\Person
     */
    public static function generateFemale()
    {
        return NameFactory::generate(0.0);
    }

    /**
     * 住所をランダムに生成
     *
     * @return jp3cki\gimei\address\Address
     */
    public static function generateAddress()
    {
        return AddressFactory::generate();
    }
}
