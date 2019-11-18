<?php
// Выход из профиля
session_start();
unset($_SESSION['user']['id']);
setcookie("email", $_POST['email'], time()-345600, "/");
setcookie("password", $_POST['password'], time()-345600, "/");
header('Location: /');
exit();
