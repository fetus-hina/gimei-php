<?php
namespace jp3cki\gimei\address;

use jp3cki\gimei\Exception;

class Dictionary
{
    private $prefectures;
    private $cities;
    private $towns;

    public function __construct($jsonPath)
    {
        $this->load($jsonPath);
    }

    public function getOneOfPrefecture()
    {
        return $this->prefectures[
            mt_rand(0, count($this->prefectures) - 1)
        ];
    }

    public function getOneOfCity()
    {
        return $this->cities[
            mt_rand(0, count($this->cities) - 1)
        ];
    }

    public function getOneOfTown()
    {
        return $this->towns[
            mt_rand(0, count($this->towns) - 1)
        ];
    }

    private function load($jsonPath)
    {
        if (!file_exists($jsonPath)) {
            throw new Exception('Could not find ' . basename($jsonPath));
        }

        $json = json_decode(file_get_contents($jsonPath), true);
        if (!isset($json['addresses']) ||
                !isset($json['addresses']['prefecture']) ||
                !isset($json['addresses']['city']) ||
                !isset($json['addresses']['town'])) {
            throw new Exception('Broken json: ' . basename($jsonPath));
        }

        $this->prefectures = $json['addresses']['prefecture'];
        $this->cities = $json['addresses']['city'];
        $this->towns = $json['addresses']['town'];
    }
}
