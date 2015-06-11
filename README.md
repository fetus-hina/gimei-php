Gimei-PHP
=========

[![Build Status](https://travis-ci.org/fetus-hina/gimei-php.svg?branch=master)](https://travis-ci.org/fetus-hina/gimei-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/fetus-hina/gimei-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/fetus-hina/gimei-php/?branch=master)
[![Code Climate](https://codeclimate.com/github/fetus-hina/gimei-php/badges/gpa.svg)](https://codeclimate.com/github/fetus-hina/gimei-php)
[![Test Coverage](https://codeclimate.com/github/fetus-hina/gimei-php/badges/coverage.svg)](https://codeclimate.com/github/fetus-hina/gimei-php/coverage)

gimei-php は日本人の名前や、日本の住所をランダムに返すライブラリ [gimei](https://github.com/willnet/gimei) を PHP 用ライブラリにポーティングしたものです。

このライブラリはあとほんの少しの期間だけ開発中です。

本家
----

https://github.com/willnet/gimei

使い方
------

### 準備 ###

1. まだ設定していなければ [Composer](https://getcomposer.org/) を使えるようにします。
   具体的な方法は [Download Composer](https://getcomposer.org/download/) を確認してください。

2. 現在のあなたのソースコードで Composer を使用していなければ、次のコマンドを実行してください。

   ```sh
   php composer.phar init
   ```

   あなたのソースコード（プロジェクト）についていくつか質問されますので適当に答えてください。
   完了すると `composer.json` ファイルが生成されます。

3. gimei-php を Composer 経由でインストールします。
    
    - 開発時にのみ使用し、本番では使用しない場合
        
        ```sh
        php composer.phar require --dev jp3cki/gimei-php
        ```

    - 本番でも使用する場合

        ```sh
        php composer.phar require jp3cki/gimei-php
        ```

4. これで利用の準備が整いました。

詳しくは Composer のウェブサイトか、Composer の解説サイトを参照してください。

なお、 Composer 経由でインストールしたライブラリ等を使用する際は、あなたのプログラムの最初の方で `vendor/autoload.php` を `require` または `include` してください。

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');
```


### 名前をランダムに返す ###

男女どちらかの名前を等確率で返します。

```php
<?php
use jp3cki\gimei\Gimei;

// require_once(__DIR__ . '/vendor/autoload.php');

$gimei = Gimei::generateName();
echo $gimei . "\n";                     // "相沢 陽菜"
echo $gimei->kanji . "\n";              // "相沢 陽菜"
echo $gimei->hiragana . "\n";           // "あいざわ ひな"
echo $gimei->katakana . "\n";           // "アイザワ ヒナ"
echo $gimei->last->kanji . "\n";        // "相沢"
echo $gimei->last->hiragana . "\n";     // "あいざわ"
echo $gimei->last->katakana . "\n";     // "アイザワ"
echo $gimei->first->kanji . "\n";       // "陽菜"
echo $gimei->first->hiragana . "\n";    // "ひな"
echo $gimei->first->katakana . "\n";    // "ヒナ"

echo $gimei->isMale . "\n";             // false (echo の挙動上 "0")
echo $gimei->isFemale . "\n";           // true  ( 〃           "1")
```

下記のように男性／女性の名前を返すことを明示的に指定できます。

```php
<?php
use jp3cki\gimei\Gimei;

// require_once(__DIR__ . '/vendor/autoload.php');

$gimei = Gimei::generateMale();     // 男性
echo $gimei->kanji . "\n";          // "山田 太郎"
echo $gimei->isMale . "\n";         // true  (echo の挙動上 "1")
echo $gimei->isFemale . "\n";       // false ( 〃           "0")

$gimei = Gimei::generateFemale();   // 女性
echo $gimei->kanji . "\n";          // "相沢 陽菜"
echo $gimei->isMale . "\n";         // false (echo の挙動上 "0")
echo $gimei->isFemale . "\n";       // true  ( 〃           "1")
```

名前のデータは `gimei` (オリジナル)プロジェクトの `names.yml` から JSON に変換して利用しています。


### 住所ランダムに返す ###

都道府県、区、市、町を組み合わせた住所情報を漢字、ひらがな、カタカナで取得することができます。
（ほとんどの場合、実在しない住所が生成されます。例えば `東京都` `名古屋市中村区` `首里末吉町` など）

```php
<?php
use jp3cki\gimei\Gimei;

// require_once(__DIR__ . '/vendor/autoload.php');

$addr = Gimei::generateAddress();
echo $addr . "\n";                          // 岡山県大島郡大和村稲木町
echo $addr->kanji . "\n";                   // 岡山県大島郡大和村稲木町
echo $addr->hiragana . "\n";                // おかやまけんおおしまぐんやまとそんいなぎちょう
echo $addr->katakana . "\n";                // オカヤマケンオオシマグンヤマトソンイナギチョウ

echo $addr->prefecture->kanji . "\n";       // 岡山県
echo $addr->prefecture->hiragana . "\n";    // おかやまけん
echo $addr->prefecture->katakana . "\n";    // オカヤマケン

echo $addr->city->kanji . "\n";             // 大島郡大和村
echo $addr->city->hiragana . "\n";          // おおしまぐんやまとそん
echo $addr->city->katakana . "\n";          // オオシマグンヤマトソン

echo $addr->town->kanji . "\n";             // 稲木町
echo $addr->town->hiragana . "\n";          // いなぎちょう
echo $addr->town->katakana . "\n";          // イナギチョウ
```

住所のデータは `gimei` (オリジナル)プロジェクトの `addresses.yml` から JSON に変換して利用しています。


CONTRIBUTING
------------

1. フォークします
2. feature branch を作成します (`git checkout -b my-new-feature`) ※master ブランチで作業しないでください。
3. 依存関係の準備をします。(`make init`)
4. ソースとテストを変更します。
5. テストとコーディングチェックを行います。
    - `make test`
    - `make check-style`
6. commit します (`git commit -m 'Add Feature' -a`)
7. push します (`git push origin my-new-feature`)
8. pull request を作成します。


名前や住所のデータを `gimei` に追従するには、

1. `third-party/gimei-original` で `git pull origin master` する等して更新を取り込んでください。
2. `util/convert-data.php` を実行します。

とすればたぶん大丈夫です。


LICENSE
-------

```
The MIT License (MIT)

Copyright (c) 2015 AIZAWA Hina <hina@bouhime.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```
