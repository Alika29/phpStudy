<?php
session_start();

unset($_SESSION['mail']);

header('Location: login.php');
exit();
?>
