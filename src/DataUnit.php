<?php

/**
 * @author AIZAWA Hina <hina@fetus.jp>
 * @copyright 2015-2019 AIZAWA Hina <hina@fetus.jp>
 * @license https://github.com/fetus-hina/gimei-php/blob/master/LICENSE MIT
 */

namespace jp3cki\gimei;

/**
 * 漢字・かな・カナをひとまとめにしたクラス
 *
 * @internal
 * @property-read string $kanji 漢字表記
 * @property-read string $hiragana かな表記
 * @property-read string $katakana カナ表記
 */
class DataUnit
{
    /**
     * 漢字表記
     * @var string
     */
    private $kanji;

    /**
     * かな表記
     * @var string
     */
    private $hiragana;

    /**
     * カナ表記
     * @var string
     */
    private $katakana;

    /**
     * コンストラクタ
     *
     * @param string[] $data [漢字, かな, カナ] の配列
     */
    public function __construct(array $data)
    {
        assert(count($data) === 3);

        $this->kanji = (string)array_shift($data);
        $this->hiragana = (string)array_shift($data);
        $this->katakana = (string)array_shift($data);
    }

    /**
     * 漢字表記を取得
     *
     * @return string
     */
    public function getKanji()
    {
        return $this->kanji;
    }

    /**
     * かな表記を取得
     *
     * @return string
     */
    public function getHiragana()
    {
        return $this->hiragana;
    }

    /**
     * カナ表記を取得
     *
     * @return string
     */
    public function getKatakana()
    {
        return $this->katakana;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getKanji();
    }

    /**
     * @param string $key
     * @return string|null
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
        }

        return null;
    }
}
