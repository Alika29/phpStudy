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
        <div style="text-align: right"><a href="logout.php">ログアウト</a></div>
            <form action="" method="POST">
                <?php if (count($errors) > 0) : ?>
                    <ul>
                        <?php foreach ($errors as $error) : ?>
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
