Gimei-PHP
=========

[![License](https://poser.pugx.org/jp3cki/gimei/license)](https://packagist.org/packages/jp3cki/gimei)
[![Latest Stable Version](https://poser.pugx.org/jp3cki/gimei/v/stable)](https://packagist.org/packages/jp3cki/gimei)
[![Build Status](https://travis-ci.org/fetus-hina/gimei-php.svg?branch=master)](https://travis-ci.org/fetus-hina/gimei-php)

gimei-php は日本人の名前や、日本の住所をランダムに返すライブラリ [gimei](https://github.com/willnet/gimei) を PHP 用ライブラリにポーティングしたものです。
テストデータの作成時などに使用します。

本家
----

https://github.com/willnet/gimei

使い方
------

### 必須環境 ###

- PHP 7.1 以上
- `json` 拡張モジュール


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
        php composer.phar require --dev jp3cki/gimei
        ```

    - 本番でも使用する場合

        ```sh
        php composer.phar require jp3cki/gimei
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

また、男女比を明示的に指定できます。（男性の割合を 0.0～1.0 で指定します）

```php
<?php
use jp3cki\gimei\Gimei;

// require_once(__DIR__ . '/vendor/autoload.php');

$gimei = Gimei::generate(0.9);      // 90% 男性、10% 女性
echo $gimei->kanji . "\n";          // "山田 太郎"
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

Copyright (c) 2015-2022 AIZAWA Hina <hina@fetus.jp>

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

CHANGE LOG
----------

- v2.0.1 - 2022-01-15
    - 依存ライブラリアップデート
    - phpdoc 等の更新
    - phpcs, phpstan による検出箇所の更新

- v2.0.0 - 2019-11-19
    - 最小要求バージョンを PHP 7.1 に更新（内容に変更はありません）

- v1.1.1 - 2015-08-19
    - 依存ライブラリアップデート（内容に変更はありません）

- v1.1.0 - 2015-07-23
    - `Gimei::generateName()` に男女比を指定できるようになりました

- v1.0.3 - 2015-07-23
    - 依存ライブラリアップデート（内容に変更はありません）

- v1.0.2 - 2015-06-19
    - 依存ライブラリアップデート（内容に変更はありません）

- v1.0.1 - 2015-06-17
    - 依存ライブラリアップデート（内容に変更はありません）

- v1.0.0 - 2015-06-13
    - initial release

備考
----

- バージョンナンバーは [セマンティック バージョニング](http://semver.org/lang/ja/) に従います。
    - `v1.0.0` に対して
        - `v1.0.1` は機能追加等を行わないただのバグ修正であることを示します。このリリースは常に適用が推奨されます。
        - `v1.1.0` は機能追加を行っていますが既存の API に影響がないことを示します。このリリースは通常は適用が推奨されます。
        - `v2.0.0` は API の互換性が損なわれたリリースであることを示します。CHANGE LOG を確認してください。
    - composer のバージョン指定においては `^` または `~` で安全に指定できます。
