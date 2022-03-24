<?php
session_start();
require('../database.php');
$error = [];


if (isset($_GET['action']) && $_GET['action'] === 'rewrite' && isset($_SESSION['form'])) {
    $form = $_SESSION['form'];
} else {
    $form = [
        'mail' => '',
        'password' => '',
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form['mail'] = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
    if ($form['mail'] === '') {
        $error['mail'] = 'blank';
    } else {
        $link = dbConnect();
        //後で変更
        $stmt = $link->prepare('SELECT count(*) FROM members WHERE mail=?');
        if (!$stmt) {
            exit($link->error);
        }
        $stmt->bind_param('s', $form['mail']);
        $success = $stmt->execute();
        if (!$success) {
            exit($link->error);
        }

        $stmt->bind_result($cnt);
        $stmt->fetch();

        if ($cnt > 0) {
            $error['mail'] = 'duplicate';
        }
    }


    $form['password'] = filter_input(INPUT_POST, 'password');
    if ($form['password'] === '') {
        $error['password'] = 'blank';
    } elseif (strlen($form['password']) < 4) {
        $error['password'] = 'length';
    }

    if (empty($error)) {

        $_SESSION['form'] = $form;
        header('Location: check.php');
        exit();
    }

}


include '../employeeRegistrationViews/index.php';
