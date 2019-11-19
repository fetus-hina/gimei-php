<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei\address;

/**
 * 住所を保持するクラス
 *
 * @property-read AddressUnit prefecture 都道府県
 * @property-read AddressUnit city 市区町村
 * @property-read AddressUnit town 大字等
 */
class Address
{
    /**
     * 都道府県
     * @var AddressUnit
     */
    private $prefecture;

    /**
     * 市区町村
     * @var AddressUnit
     */
    private $city;

    /**
     * 大字等
     * @var AddressUnit
     */
    private $town;

    /**
     * コンストラクタ
     *
     * @param AddressUnit $prefecture 都道府県
     * @param AddressUnit $city 市区町村
     * @param AddressUnit $town 大字等
     */
    public function __construct(AddressUnit $prefecture, AddressUnit $city, AddressUnit $town)
    {
        $this->prefecture = $prefecture;
        $this->city = $city;
        $this->town = $town;
    }

    /**
     * 漢字表記を取得
     *
     * @return string
     */
    public function getKanji()
    {
        return $this->toString('kanji');
    }

    /**
     * かな表記を取得
     *
     * @return string
     */
    public function getHiragana()
    {
        return $this->toString('hiragana');
    }

    /**
     * カナ表記を取得
     *
     * @return string
     */
    public function getKatakana()
    {
        return $this->toString('katakana');
    }

    /**
     * 都道府県を取得
     *
     * @return AddressUnit
     */
    public function getPrefecture()
    {
        return $this->prefecture;
    }

    /**
     * 市区町村を取得
     *
     * @return AddressUnit
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * 大字等を取得
     *
     * @return AddressUnit
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @inherit
     * @return string
     */
    public function __toString()
    {
        return $this->getKanji();
    }

    /**
     * @inherit
     * @param string $key
     * @return string|null
     */
    public function __get($key)
    {
        switch ($key) {
            case 'kanji':
                return $this->getKanji();

            case 'hiragana':
                return $this->getHiragana();

            case 'katakana':
                return $this->getKatakana();

            case 'prefecture':
                return $this->getPrefecture();

            case 'city':
                return $this->getCity();

            case 'town':
                return $this->getTown();
        }
    }

    /**
     * 完全な住所を取得
     *
     * @param string $key "kanji" | "hiragana" | "katakana"
     * @return string
     */
    private function toString($key)
    {
        return sprintf(
            '%s%s%s',
            $this->prefecture->$key,
            $this->city->$key,
            $this->town->$key
        );
    }
}
