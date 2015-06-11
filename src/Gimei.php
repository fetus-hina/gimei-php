<?php
namespace jp3cki\gimei;

use jp3cki\gimei\name\Gender;
use jp3cki\gimei\name\Factory as NameFactory;
use jp3cki\gimei\address\Factory as AddressFactory;

class Gimei
{
    public static function generateName()
    {
        return NameFactory::generate();
    }

    public static function generateMale()
    {
        return NameFactory::generate(Gender::MALE);
    }

    public static function generateFemale()
    {
        return NameFactory::generate(Gender::FEMALE);
    }

    public static function generateAddress()
    {
        return AddressFactory::generate();
    }
}
