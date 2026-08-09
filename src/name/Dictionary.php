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
 */
class Dictionary
{
    /**
     * 男性名のリスト
     * @var string[][]
     */
    private array $maleFirstNames = [];

    /**
     * 女性名のリスト
     * @var string[][]
     */
    private array $femaleFirstNames = [];

    /**
     * 名字のリスト
     * @var string[][]
     */
    private array $lastNames = [];

    /**
     * コンストラクタ
     *
     * @param string $jsonPath データファイルのパス
     */
    public function __construct(string $jsonPath)
    {
        $this->load($jsonPath);
    }

    /**
     * 名前をランダムに選択して返す
     *
     * @param string $gender 選択する性。Gender::MALE または Gender::FEMALE
     * @return string[]
     * @phpstan-param Gender::MALE|Gender::FEMALE $gender
     */
    public function getOneOfFirstName(string $gender): array
    {
        return match ($gender) {
            Gender::MALE => $this->maleFirstNames[
                mt_rand(0, count($this->maleFirstNames) - 1)
            ],
            Gender::FEMALE => $this->femaleFirstNames[
                mt_rand(0, count($this->femaleFirstNames) - 1)
            ],
            default => throw new Exception('Invalid gender: ' . $gender),
        };
    }

    /**
     * 名字をランダムに選択して返す
     *
     * @return string[]
     */
    public function getOneOfLastName(): array
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
    private function load(string $jsonPath): void
    {
        if (!file_exists($jsonPath)) {
            throw new Exception('Could not find ' . basename($jsonPath));
        }

        $json = json_decode((string)file_get_contents($jsonPath), true);
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
