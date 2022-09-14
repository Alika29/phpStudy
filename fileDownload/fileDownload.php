<?php
require_once 'vendor/autoload.php';

//Googleドライブの認証してfileをgetするらしい

//認証パラメータを設定する
//クライアントオブジェクトを作成
// $client = new Google_Client();
$client = new Google\Client();
//アプリケーションのクライアントID
$client->setAuthConfig('client_secrets.json');
$client->setApplicationName("FileDownload");
//スペースで区切られたスコープのリスト
// $client->addScope(Google_Service_Drive::Drive_METADATA_READONLY);
$client->addScope(Google\Service\Drive::DRIVE_METADATA_READONLY);

//リダイレクトURI
$redirect_uri = 'http://localhost:8888/php_test/fileDownload/';
$client->setRedirectUri($redirect_uri);
// $client->setRedirectUri('http:// '.$_SERVER['HTTP_HOST'].'/oauth2callback.php');

//アクセス トークンを更新できるかどうか
$client->setAccessType('offline');
$client->setApprovalPrompt('consent');

//認証コードとアクセストークンを交換する
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
}

//OAuth2.0サーバーへユーザーをリダイレクト
//Google の OAuth 2.0 サーバーからのアクセスをリクエストする URL を生成します。
$auth_url = $client->createAuthUrl();
//ユーザーを $auth_url にリダイレクトします。
header('Location:'.filter_var($auth_url, FILTER_SANITIZE_URL));

//更新トークンとアクセス トークンの認証コードを交換する
//OAuth2.0サーバーからの返信を処理
$client->authenticate($_GET['code']);
//メソッドを使用して取得
$access_token=$client->getAccessToken();

//Google APIを呼び出す
//アクセス トークンの認証コードを交換
$client->setAccessToken($access_token);

// $service = new Google_Service_Drive($client);
$drive = new Google\Service\Drive($client);
$files = $drive->files->listFiles(array())->getItems();
//$serviceに認証を終わらせたら情報入れるっぽい？

//fileをgetするコード
// /**
//  * Print a file's metadata.
//  *
//  * @param Google_Service_Drive $service Drive API service instance.
//  * @param string $fileId ID of the file to print metadata for.
//  */
// function printFile($service, $fileId) {
//     try {
//         $file = $service->files->get($fileId);

//         print "Title: " . $file->getTitle();
//         print "Description: " . $file->getDescription();
//         print "MIME type: " . $file->getMimeType();
//     } catch (Exception $e) {
//         print "An error occurred: " . $e->getMessage();
//     }
//     }

//     /**
//    * Download a file's content.
//    *
//    * @param Google_Service_Drive $service Drive API service instance.
//    * @param File $file Drive File instance.
//    * @return String The file's content if successful, null otherwise.
//    */
//     function downloadFile($service, $file) {
//     $downloadUrl = $file->getDownloadUrl();
//     if ($downloadUrl) {
//         $request = new Google_Http_Request($downloadUrl, 'GET', null, null);
//         $httpRequest = $service->getClient()->getAuth()->authenticatedRequest($request);
//         if ($httpRequest->getResponseHttpCode() == 200) {
//         return $httpRequest->getResponseBody();
//         } else {
//         // An error occurred.
//         return null;
//         }
//     } else {
//       // The file doesn't have any content stored on Drive.
//         return null;
//     }
// }
