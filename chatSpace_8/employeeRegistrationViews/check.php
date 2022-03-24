<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>会員登録</title>
</head>

<body>
    <header>
        <h1>会員登録</h1>
    </header>

	<main>
		<p>記入した内容を確認して、「登録する」ボタンをクリックしてください</p>
		<form action="" method="post">
			<dl>
				<dt>メールアドレス</dt>
				<dd><?php echo htmlspecialchars($form['mail'], ENT_QUOTES); ?></dd>
				<dt>パスワード</dt>
				<dd>
					【表示されません】
				</dd>
			</dl>
			<div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" /></div>
		</form>
	</main>
</body>

</html>
