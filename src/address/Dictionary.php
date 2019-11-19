<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei\address;

use jp3cki\gimei\Exception;

/**
 * データファイルを読み込み保持するクラス
 *
 * @property-read array prefectures
 * @property-read array cities
 * @property-read array towns
 */
class Dictionary
{
    /**
     * 都道府県のリスト
     * @var string[][]
     */
    private $prefectures;
    
    /**
     * 市区町村のリスト
     * @var string[][]
     */
    private $cities;

    /**
     * 大字等のリスト
     * @var string[][]
     */
    private $towns;

    /**
     * コンストラクタ
     *
     * @param string $jsonPath データファイルのパス
     */
    public function __construct($jsonPath)
    {
        $this->load($jsonPath);
    }

    /**
     * 都道府県をランダムに選択して返す
     *
     * @return string[]
     */
    public function getOneOfPrefecture()
    {
        return $this->prefectures[
            mt_rand(0, count($this->prefectures) - 1)
        ];
    }

    /**
     * 市区町村をランダムに選択して返す
     *
     * @return string[]
     */
    public function getOneOfCity()
    {
        return $this->cities[
            mt_rand(0, count($this->cities) - 1)
        ];
    }

    /**
     * 大字等をランダムに選択して返す
     *
     * @return string[]
     */
    public function getOneOfTown()
    {
        return $this->towns[
            mt_rand(0, count($this->towns) - 1)
        ];
    }

    /**
     * ファイルを読み込む
     *
     * @param string $jsonPath ファイルパス
     */
    private function load($jsonPath)
    {
        if (!file_exists($jsonPath)) {
            throw new Exception('Could not find ' . basename($jsonPath));
        }

        $json = json_decode(file_get_contents($jsonPath), true);
        if (
            !isset($json['addresses']) ||
            !isset($json['addresses']['prefecture']) ||
            !isset($json['addresses']['city']) ||
            !isset($json['addresses']['town'])
        ) {
            throw new Exception('Broken json: ' . basename($jsonPath));
        }

        $this->prefectures = $json['addresses']['prefecture'];
        $this->cities = $json['addresses']['city'];
        $this->towns = $json['addresses']['town'];
    }
}
