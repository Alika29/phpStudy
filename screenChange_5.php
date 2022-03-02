<?php
    $date = new DateTime();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>画面変化</title>
        <meta name="description" content="画面変化">
    </head>

    <body>
        <header class="main-header">
            <h1>画面変化</h1>
        </header>

        <main>
            <form action="screenChange.php" method="post">
                <?php if (isset($_POST['time'])) : ?>
                    <p><?php echo $date->format('Y-m-d'); ?></p>
                <?php else : ?>
                    <p>ここに時間を表示します</p>
                <?php endif; ?>
                    <button type="submit" name="time">日付を表示する</button>
            </form>
        </main>
        <footer>
        </footer>
    </body>
</html>
