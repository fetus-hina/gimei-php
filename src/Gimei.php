<?php
/**
 * @author AIZAWA Hina <hina@bouhime.com>
 * @copyright 2015 AIZAWA Hina <hina@bouhime.com>
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
     * @return jp3cki\gimei\name\Person
     */
    public static function generateName()
    {
        return NameFactory::generate();
    }

    /**
     * 男性名をランダムに生成
     *
     * @return jp3cki\gimei\name\Person
     */
    public static function generateMale()
    {
        return NameFactory::generate(Gender::MALE);
    }

    /**
     * 女性名をランダムに生成
     *
     * @return jp3cki\gimei\name\Person
     */
    public static function generateFemale()
    {
        return NameFactory::generate(Gender::FEMALE);
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
