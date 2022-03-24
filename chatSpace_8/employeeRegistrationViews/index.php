<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>会員登録</title>
    </head>

    <body>
        <header>
            <h1>会員登録</h1>
        </header>

        <main>
            <p>以下のフォームに必要事項をご記入ください。</p>
            <form action="" method="POST">
                <dl>
                    <dt>
                        メールアドレス<span class="required">必須</span>
                    </dt>
                    <dd>
                        <input type="text" id="mail" name="mail" size="35" maxlength="255" value="<?php echo htmlspecialchars($form['mail'], ENT_QUOTES); ?>">
                        <?php if (isset($error['mail']) && $error['mail'] === 'blank') : ?>
                            <p class="error">* メールアドレスを入力してください</p>
                        <?php endif ; ?>
                        <?php if (isset($error['mail']) && $error['mail'] === 'duplicate') : ?>
                        <p class="error">* 指定されたメールアドレスはすでに登録されています</p>
                        <?php endif ; ?>
                    </dd>
                    <dt>
                        パスワード<span class="required">必須</span>
                    </dt>
                    <dd>
                        <input type="password" name="password" size="10" maxlength="20" value="<?php echo htmlspecialchars($form['password'], ENT_QUOTES); ?>">
                        <?php if (isset($error['password']) && $error['password'] === 'blank') : ?>
                            <p class="error">* パスワードを入力してください</p>
                        <?php endif; ?>
                        <?php if (isset($error['password']) && $error['password'] === 'length') : ?>
                            <p class="error">* パスワードは4文字以上で入力してください</p>
                        <?php endif; ?>
                    </dd>
                </dl>
                <div>
                    <input type="submit" value="入力内容を確認する">
                </div>
            </form>
        </main>
    </body>
</html>
