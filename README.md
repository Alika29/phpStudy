# phpstudy
# Google Drive API

Google APIを使ってGoogle Driveのファイル名を取得する方法

Google APIsのページに移動

Google Drive APIを検索→有効化

新しいプロジェクトを作成


Composerのインストール

Ubuntuだと

$ apt install composer


composer.jsonの作成

$ mkdir 作業フォルダ名

$ cd 作業フォルダ名


全部Enter

$ composer init


composer.jsonに追記

"require": {
  "google/apiclient": "^2.0"
}


$composer install

Google Cloud Platformの認定情報を作成→OAuthクライアントID→承認済みのリダイレクト URIにURL入れる→作ってからJDONをダウンロードする→credentials.jsonと名前を変える。

その後公式通りStepを進める

https://developers.google.com/drive/api/quickstart/php


実行フォルダ
./composer.json
./composer.lock
./credentials.json
./quickstart.php
./vendor


認証ページへのリンクが表示されるのでリンク先へ移動し、認証します。

codeは表示されてサイトのURLのcode=から&までを入れるとGoogle Driveのファイル名が表示される。


