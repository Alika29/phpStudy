<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>表示</title>
        <meta name="description" content="画面変化">
    </head>

    <body>
        <header class="main-header">
            <h1>表示</h1>
        </header>

        <main>
            <form action="textDisplay.php" method="post">
                <?php if (isset($_POST['text'])) : ?>
                    <p><?php echo ($_POST['text']); ?></p>
                    <?php else : ?>
                        <p>まだテキストが入力されていません</p>
                        <?php endif; ?>

                        <input type="text" name="text" value="">
                        <button type="submit" name="time">入力</button>

                        <!-- <input type="submit" name="send" value="入力"> -->
            </form>
        </main>
        <footer>
        </footer>
    </body>
</html>
