<?php
session_start();
require('../database.php');

function intoTable($link, array $form)
{
	$password = password_hash($form['password'], PASSWORD_DEFAULT);
	$sql =<<<EOT
    INSERT INTO members(
        mail,
        password
        ) VALUES (
    "{$form['mail']}",
    "$password"
)
EOT;
    $result = mysqli_query($link, $sql);
    if (!$result) {
        error_log('Error: fail into chat');
        error_log('Debugging Error: ' . mysqli_error($link));
    }
}


if (isset($_SESSION['form'])) {
	$form = $_SESSION['form'];

} else {
	header('Location: index.php');
	exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$link = dbConnect();
	intoTable($link,$form);

	unset($_SESSION['form']);
	header('Location: ../employeeRegistrationViews/thanks.php');
}
include '../employeeRegistrationViews/check.php';
