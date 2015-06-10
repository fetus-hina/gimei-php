<?php
namespace jp3cki\gimei\name;

use Symfony\Component\Yaml\Yaml;
use jp3cki\gimei\Exception;

class Factory
{
    const YAML_REL_PATH = '../../data/names.yml';
    
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

        $yamlPath = __DIR__ . '/' . self::YAML_REL_PATH;
        if (!$yamlPath) {
            throw new Exception('Could not find ' . basename($yamlPath));
        }

        $yaml = Yaml::parse(file_get_contents($yamlPath), true, false, false);
        if (!isset($yaml['first_name']) || !isset($yaml['last_name'])) {
            throw new Exception('Broken yaml: ' . basename($yamlPath));
        }

        foreach (['male', 'female'] as $genderKey) {
            $data['firstName'][$genderKey] = $yaml['first_name'][$genderKey];
        }
        $data['lastName'] = $yaml['last_name'];
        
        self::$data = $data;
    }
}
