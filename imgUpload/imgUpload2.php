<?php
if ($_FILES['upfile']['error'] !== UPLOAD_ERR_OK) {
  $msg = [
    UPLOAD_ERR_INI_SIZE => '画像サイズが規定を越えています。',
    UPLOAD_ERR_FORM_SIZE => '画像サイズが規定を越えています。',
    UPLOAD_ERR_PARTIAL => 'ファイルが一部しかアップロードされていませんでした。',
    UPLOAD_ERR_NO_FILE => '画像はアップロードされませんでした。',
    UPLOAD_ERR_NO_TMP_DIR => '一時保存フォルダーが存在しません。',
    UPLOAD_ERR_CANT_WRITE => '書き込みに失敗しました。',
    UPLOAD_ERR_EXTENSION => 'アップロードが中断されました。'
  ];
  $err_msg = $msg[$_FILES['upfile']['error']];
} elseif (!in_array(
strtolower(pathinfo($_FILES['upfile']['name'])['extension']),
['gif', 'jpg', 'jpeg', 'png'])) {
$err_msg = '画像以外のファイルはアップロードできません。';
} elseif (!in_array(
  finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['upfile']['tmp_name']),
  ['image/gif', 'image/jpg', 'image/jpeg', 'image/png'])) {
$err_msg = 'ファイルの内容が画像ではありません。';
} else {
  $src = $_FILES['upfile']['tmp_name'];
  // $dest = mb_convert_encoding($_FILES['upfile']['name'], 'SJIS-WIN', 'UTF-8');
  $dest = $_FILES['upfile']['name'];
  if (!move_uploaded_file($src, 'upload/'.$dest)) {
    $err_msg = 'アップロードが失敗しました。';
  }
}
if (isset($err_msg)) {
  exit('<div style="color:Red;">'.$err_msg.'</div>');
}
header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/imgUpload1.php');
