<?php
namespace jp3cki\gimei\name;

class Person
{
    private $firstName;
    private $lastName;
    private $isMale;

    public function __construct(NameUnit $firstName, NameUnit $lastName, $isMale)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->isMale = !!$isMale;
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

    public function isMale()
    {
        return $this->isMale;
    }

    public function isFemale()
    {
        return !$this->isMale;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
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

            case 'isMale':
            case 'is_male':
                return $this->isMale();

            case 'isFemale':
            case 'is_female':
                return $this->isFemale();

            case 'firstName':
            case 'first_name':
            case 'first':
                return $this->getFirstName();

            case 'lastName':
            case 'last_name':
            case 'last':
                return $this->getLastName();
        }
    }

    private function toString($key)
    {
        return sprintf(
            '%s %s',
            $this->lastName->$key,
            $this->firstName->$key
        );
    }
}
