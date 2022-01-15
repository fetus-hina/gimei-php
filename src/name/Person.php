<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei\name;

/**
 * （偽名の）ある人を表すクラス
 *
 * 名字・名前の漢字・かな・カナ表記と性別を保持する
 *
 * @property-read NameUnit $first 名前
 * @property-read NameUnit $firstName 名前
 * @property-read NameUnit $first_name 名前
 * @property-read NameUnit $last 名字
 * @property-read NameUnit $lastName 名字
 * @property-read NameUnit $last_name 名字
 * @property-read bool $isFemale 女性であれば true
 * @property-read bool $isMale 男性であれば true
 * @property-read bool $is_female 女性であれば true
 * @property-read bool $is_male 男性であれば true
 * @property-read string $hiragana フルネームひらがな表記
 * @property-read string $kanji フルネーム漢字表記
 * @property-read string $katakana フルネームカタカナ表記
 */
class Person
{
    /**
     * 名前
     * @var NameUnit
     */
    private $firstName;

    /**
     * 名字
     * @var NameUnit
     */
    private $lastName;

    /**
     * 性別。男性なら true
     * @var bool
     */
    private $isMale;

    /**
     * コンストラクタ
     *
     * @param NameUnit $firstName 名前
     * @param NameUnit $lastName 名字
     * @param bool $isMale 男性ならtrue、女性ならfalse
     */
    public function __construct(NameUnit $firstName, NameUnit $lastName, $isMale)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->isMale = !!$isMale;
    }

    /**
     * 漢字表記を取得
     *
     * @return string
     */
    public function getKanji()
    {
        return $this->toString('kanji');
    }

    /**
     *
     * かな表記を取得
     *
     * @return string
     */
    public function getHiragana()
    {
        return $this->toString('hiragana');
    }

    /**
     * カナ表記を取得
     *
     * @return string
     */
    public function getKatakana()
    {
        return $this->toString('katakana');
    }

    /**
     * 性別を取得。男性なら true
     *
     * @return bool
     */
    public function isMale()
    {
        return $this->isMale;
    }

    /**
     * 性別を取得。女性なら true
     *
     * @return bool
     */
    public function isFemale()
    {
        return !$this->isMale;
    }

    /**
     * 名前を取得
     *
     * @return NameUnit
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * 名字を取得
     *
     * @return NameUnit
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @inherit
     * @return string
     */
    public function __toString()
    {
        return $this->getKanji();
    }

    /**
     * @inherit
     * @param string $key
     * @return bool|string|null
     */
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

        return null;
    }

    /**
     * 名字と名前をフォーマットした文字列を取得
     *
     * @param string $key "kanji" | "hiragana" | "katakana"
     * @return string
     */
    private function toString($key)
    {
        return sprintf(
            '%s %s',
            $this->lastName->$key,
            $this->firstName->$key
        );
    }
}
