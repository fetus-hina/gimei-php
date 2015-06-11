<?php
namespace jp3cki\gimei\address;

use jp3cki\gimei\Exception;

class Factory
{
    const JSON_REL_PATH = '../../data/addresses.json';
    
    private static $dictionary = null;

    public static function generate()
    {
        if (self::$dictionary === null) {
            self::loadData();
        }

        $dict = self::$dictionary;
        return new Address(
            new AddressUnit($dict->getOneOfPrefecture()),
            new AddressUnit($dict->getOneOfCity()),
            new AddressUnit($dict->getOneOfTown())
        );
    }

    private static function loadData()
    {
        $jsonPath = __DIR__ . '/' . self::JSON_REL_PATH;
        self::$dictionary = new Dictionary($jsonPath);
    }
}
