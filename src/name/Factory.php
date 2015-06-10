<?php
namespace jp3cki\gimei\name;

use jp3cki\gimei\Exception;

class Factory
{
    const JSON_REL_PATH = '../../data/names.json';
    
    private static $data = null;

    public static function generate($gender = Gender::BOTH)
    {
        if (self::$data === null) {
            self::loadData();
        }
        if ($gender !== Gender::MALE && $gender !== Gender::FEMALE) {
            $gender = (mt_rand() % 2 === 0) ? Gender::MALE : Gender::FEMALE;
        }

        $genderKey = ($gender === Gender::MALE) ? 'male' : 'female';

        $firstNameCount = count(self::$data['firstName'][$genderKey]);
        $firstName = self::$data['firstName'][$genderKey][mt_rand(0, $firstNameCount - 1)];

        $lastNameCount = count(self::$data['lastName']);
        $lastName = self::$data['lastName'][mt_rand(0, $lastNameCount - 1)];

        return new Person(
            new NameUnit($firstName),
            new NameUnit($lastName),
            $gender === Gender::MALE
        );
    }

    private static function loadData()
    {
        $data = [
            'firstName' => [
                'male' => [],
                'female' => [],
            ],
            'lastName' => []
        ];

        $jsonPath = __DIR__ . '/' . self::JSON_REL_PATH;
        if (!$jsonPath) {
            throw new Exception('Could not find ' . basename($jsonPath));
        }

        $json = json_decode(file_get_contents($jsonPath), true);
        if (!isset($json['first_name']) || !isset($json['last_name'])) {
            throw new Exception('Broken json: ' . basename($jsonPath));
        }

        foreach (['male', 'female'] as $genderKey) {
            $data['firstName'][$genderKey] = $json['first_name'][$genderKey];
        }
        $data['lastName'] = $json['last_name'];
        
        self::$data = $data;
    }
}
