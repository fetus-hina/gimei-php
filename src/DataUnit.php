<?php
namespace jp3cki\gimei;

class DataUnit
{
    private $kanji;
    private $hiragana;
    private $katakana;

    public function __construct(array $data)
    {
        $this->kanji = array_shift($data);
        $this->hiragana = array_shift($data);
        $this->katakana = array_shift($data);
    }

    public function getKanji()
    {
        return $this->kanji;
    }

    public function getHiragana()
    {
        return $this->hiragana;
    }

    public function getKatakana()
    {
        return $this->katakana;
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
        }
    }
}
