<?php
namespace jp3cki\gimei\name;

use jp3cki\gimei\Exception;

class Dictionary
{
    private $maleFirstNames;
    private $femaleFirstNames;
    private $lastNames;

    public function __construct($jsonPath)
    {
        $this->load($jsonPath);
    }

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

    public function getOneOfLastName()
    {
        return $this->lastNames[
            mt_rand(0, count($this->lastNames) - 1)
        ];
    }

    private function load($jsonPath)
    {
        if (!file_exists($jsonPath)) {
            throw new Exception('Could not find ' . basename($jsonPath));
        }

        $json = json_decode(file_get_contents($jsonPath), true);
        if (!isset($json['first_name']['male']) ||
                !isset($json['first_name']['female']) ||
                !isset($json['last_name'])) {
            throw new Exception('Broken json: ' . basename($jsonPath));
        }

        $this->maleFirstNames = $json['first_name']['male'];
        $this->femaleFirstNames = $json['first_name']['female'];
        $this->lastNames = $json['last_name'];
    }
}
