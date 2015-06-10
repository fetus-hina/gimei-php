<?php
namespace jp3cki\gimei\name;

use jp3cki\gimei\Exception;

class Factory
{
    const JSON_REL_PATH = '../../data/names.json';
    
    private static $dictionary = null;

    public static function generate($gender = Gender::BOTH)
    {
        if (self::$dictionary === null) {
            self::loadData();
        }
        if ($gender !== Gender::MALE && $gender !== Gender::FEMALE) {
            $gender = (mt_rand() % 2 === 0) ? Gender::MALE : Gender::FEMALE;
        }

        $dict = self::$dictionary;

        return new Person(
            new NameUnit($dict->getOneOfFirstName($gender)),
            new NameUnit($dict->getOneOfLastName()),
            $gender === Gender::MALE
        );
    }

    private static function loadData()
    {
        $jsonPath = __DIR__ . '/' . self::JSON_REL_PATH;
        self::$dictionary = new Dictionary($jsonPath);
    }
}
