<?php
namespace jp3cki\gimei\address;

class Address
{
    private $prefecture;
    private $city;
    private $town;

    public function __construct(AddressUnit $prefecture, AddressUnit $city, AddressUnit $town)
    {
        $this->prefecture = $prefecture;
        $this->city = $city;
        $this->town = $town;
    }

    public function getKanji()
    {
        return $this->toString('kanji');
    }

    public function getHiragana()
    {
        return $this->toString('hiragana');
    }

    public function getKatakana()
    {
        return $this->toString('katakana');
    }

    public function getPrefecture()
    {
        return $this->prefecture;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function __toString()
    {
        return $this->getKanji();
    }

    public function __get($key)
    {
        switch ($key) {
            case 'kanji':
                return $this->getKanji();

            case 'hiragana':
                return $this->getHiragana();

            case 'katakana':
                return $this->getKatakana();

            case 'prefecture':
                return $this->getPrefecture();

            case 'city':
                return $this->getCity();

            case 'town':
                return $this->getTown();
        }
    }

    private function toString($key)
    {
        return sprintf(
            '%s%s%s',
            $this->prefecture->$key,
            $this->city->$key,
            $this->town->$key
        );
    }
}
