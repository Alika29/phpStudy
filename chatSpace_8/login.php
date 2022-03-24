<?php
session_start();
require('database.php');

$error = [];
$mail = '';
$password = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password');
    if ($mail === '' || $password === '') {
    $error['login'] = 'blank';
    } else {
        $db = dbconnect();
        $stmt = $db->prepare('select password from members where mail=? limit 1');
        if (!$stmt) {
            exit($db->error);
        }

        $stmt->bind_param('s', $mail);
        $success = $stmt->execute();
        if (!$success) {
            exit($db->error);
        }

        $stmt->bind_result($hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            session_regenerate_id();
            $_SESSION['mail'] = $mail;
            header('Location: index.php');
            exit();
        } else {
            $error['login'] = 'failed';
        }
    }
}

include 'chatViews/login.php';
