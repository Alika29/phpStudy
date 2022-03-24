<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ログインする</title>
    </head>

    <body>
        <header>
            <h1>ログインする</h1>
        </header>
        <main>
            <div id="lead">
                <p>メールアドレスとパスワードを記入してログインしてください。</p>
                <p>入会手続きがまだの方はこちらからどうぞ。</p>
                <p>&raquo;<a href="employeeRegistration">入会手続きをする</a></p>
            </div>
            <form action="" method="post">
                <dl>
                    <dt>メールアドレス</dt>
                    <dd>
                        <input type="text" name="mail" size="35" maxlength="255" value="<?php echo htmlspecialchars($form['mail'], ENT_QUOTES); ?>">

                        <?php if (isset($error['login']) && $error['login'] === 'failed'): ?>
                            <p class="error">* ログインに失敗しました。正しくご記入ください。</p>
                        <?php endif; ?>
                    </dd>
                    <dt>パスワード</dt>
                    <dd>
                        <input type="password" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($form['password'], ENT_QUOTES); ?>">
                    </dd>
                    <?php if (isset($error['login']) && $error['login'] === 'blank'): ?>
                            <p class="error">* メールアドレスとパスワードをご記入ください</p>
                    <?php endif; ?>
                </dl>
                <div>
                    <input type="submit" value="ログインする">
                </div>
            </form>
        </main>
    </body>
</html>
