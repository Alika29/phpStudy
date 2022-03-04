<?php
$errors =[];

function dbConnect()
{
    $link = new mysqli('localhost','root','','chatspace');
    if ($link->connect_error) {
        echo $link->connect_error;
        exit ();
    }
    return $link;
}

function validate($chat)
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

function intoTable($link, $chat)
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
    $errors = validate($chats);
    if (!count($errors)) {
        $link = dbConnect();
        intoTable($link,$chats);
        mysqli_close($link);
    }
}

$link = dbConnect();
$chats = chats($link);
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>チャット</title>
    </head>
    <body>
        <header>
            <h1>チャット</h1>
        </header>
        <main>
            <form action="" method="POST">
            <?php if (count($errors)) : ?>
                <ul>
                    <?php foreach($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
                <div class="form-group">
                    <label for="name">ニックネーム</label>
                    <input type="text" id="name" name="name" value="">
                </div>
                <div class="form-group">
                    <div><label for="chat">コメント</label></div>
                    <textarea type="text" id="chat" name="chat" cols="100" rows="10" value=""></textarea>
                </div>
                <input type="submit" name="send" value="入力">

                <?php if (count($chats) > 0) : ?>
                    <?php foreach ($chats as $chat) : ?>
                        <div>
                            <div>
                                No.<?php echo ($chat['id']); ?>
                            </div>
                            <div>
                                <?php echo ($chat['name']); ?> : <?php echo ($chat['chat']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>コメントはまだ登録されていません。</p>
                <?php endif; ?>
            </form>
        </main>
    </body>
</html>
