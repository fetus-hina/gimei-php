<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei\name;

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
     * 男性名のリスト
     * @var string[][]
     */
    private $maleFirstNames;

    /**
     * 女性名のリスト
     * @var string[][]
     */
    private $femaleFirstNames;

    /**
     * 名字のリスト
     * @var string[][]
     */
    private $lastNames;

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
     * 名前をランダムに選択して返す
     *
     * @param mixed Gender::MALE | Gender::FEMALE 選択する性
     * @return string[]
     */
    public function getOneOfFirstName($gender)
    {
        if ($gender === Gender::MALE) {
            return $this->maleFirstNames[
                mt_rand(0, count($this->maleFirstNames) - 1)
            ];
        } elseif ($gender === Gender::FEMALE) {
            return $this->femaleFirstNames[
                mt_rand(0, count($this->femaleFirstNames) - 1)
            ];
        }
        throw new Exception('Invalid gender: ' . $gender);
    }

    /**
     * 名字をランダムに選択して返す
     *
     * @return string[]
     */
    public function getOneOfLastName()
    {
        return $this->lastNames[
            mt_rand(0, count($this->lastNames) - 1)
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
            !isset($json['first_name']['male']) ||
            !isset($json['first_name']['female']) ||
            !isset($json['last_name'])
        ) {
            throw new Exception('Broken json: ' . basename($jsonPath));
        }

        $this->maleFirstNames = $json['first_name']['male'];
        $this->femaleFirstNames = $json['first_name']['female'];
        $this->lastNames = $json['last_name'];
    }
}
