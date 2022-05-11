<?php
require_once 'vendor/autoload.php';

//Googleドライブの認証してfileをgetするらし

//Googleドライブの認証
//クライアントオブジェクトを作成
$client = new Google_Client();
$client->setAuthConfig('client_secrets.json');
$client->setApplicationName("FileDownload");
$client->addScope(Google_Service_Drive::Drive_METADATA_READONLY);
$client->setRedirectUri('http:// '.$_SERVER['HTTP_HOST'].'/oauth2callback.php');

//OAuth2.0サーバーへユーザーをリダイレクト
$auth_url = $client->createAuthUrl();
header('Location:'.filter_var($auth_url, FILTER_SANITIZE_URL));

//OAuth2.0サーバーからの返信を処理
$client->authenticate($_GET['code']);
$access_token=$client->getAccessToken();

//Google APIを呼び出す
$client->setAccessToken($access_token);
$service = new Google_Service_Drive($client);

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
