<?php
$errors = [];

function dbConnect()
{
    $link = new mysqli('localhost','root','','chatspace');
    if ($link->connect_error) {
        echo $link->connect_error;
        exit ();
    }
    return $link;
}

function validate($chat, array $errors)
{
    if (!strlen($chat['name'])) {
        $errors['name'] = 'ニックネームを入力してください';
    }

    if (!strlen($chat['chat'])) {
        $errors['chat'] = 'コメントを入力してください';
    } elseif($chat['chat'] > 100) {
        $errors['chat'] = 'コメントは100文字以内で入力してください';
    }
    return $errors;
}

function intoTable($link, array $chat)
{
    $sql =<<<EOT
    INSERT INTO chats (
        name,
        chat
        ) VALUES (
    "{$chat['name']}",
    "{$chat['chat']}"
)
EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail to create chat');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}

function chats($link)
{
    $chats = [];
    $sql = 'SELECT * FROM chats;';
    $results = mysqli_query($link, $sql);
    while ($list = mysqli_fetch_assoc($results))
    {
        $chats[] = $list;
    }
    mysqli_free_result($results);
    return $chats;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $chats = [
        'name' => $_POST['name'],
        'chat' => $_POST['chat'],
    ];

    $errors = validate($chats, $errors);

    if (!count($errors)) {
        $link = dbConnect();
        intoTable($link,$chats);
        mysqli_close($link);
    }
}

$link = dbConnect();
$chats = chats($link);
mysqli_close($link);


include 'views/index.php';
