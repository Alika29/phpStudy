<?php
$db = new mysqli('localhost','root','','db_study');
if ($db->connect_error) {
    echo $db->connect_error;
    exit ();
}

$sql = 'SELECT * FROM chat';
$result = mysqli_query($db, $sql);

while ($data = mysqli_fetch_array($result)) {
    echo '<p>' . $data['id'] . ':' . $data['name'] . ':' . $data['comment'];
}

$db = mysqli_close($db);
if (!$db) {
    exit('データベースとの接続を閉じられません。');
}
