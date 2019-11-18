<?php
//Авторизация пользователя
session_start();
$_SESSION['old_val'] = $_POST;

if (empty($_POST['email']) || empty($_POST['password'])) {
    if (empty($_POST['email'])) {
        $_SESSION['err']['email'] = 'Введите email';
    }
    if (empty($_POST['password'])) {
        $_SESSION['err']['password'] = 'Введите пароль';
    }
    header('Location: /login.php');
    exit();
}
if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) || strlen($_POST['password']) < 6) {
    if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        $_SESSION['err']['email'] = 'Неккоретно введен email';
    }
    if (strlen($_POST['password']) < 6) {
        $_SESSION['err']['password'] = 'Пароль должен содержать не менее 6 символов';
    }
    header('Location: /login.php');
    exit();
}
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    if (!empty($_POST['password'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $statement = $pdo->prepare($sql);
        $statement->bindParam('email', $_POST['email']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if (password_verify($_POST['password'], $result[0]['password']) && $_POST['email'] == $result[0]['email']) {
            if ($_POST['remember'] == 1) {
                setcookie("email", $_POST['email'], time() + 345600, "/");
                setcookie("password", $result[0]['password'], time() + 345600, "/");
            } else {
                setcookie("email", $_POST['email'], time() - 345600, "/");
                setcookie("password", $_POST['password'], time() - 345600, "/");
            }
            $_SESSION['user']['id'] = $result[0]['id'];
            header('Location: /index.php');
            exit();
        } else {
            $_SESSION['warning'] = 'Неверные email или пароль';
            header("Location: /login.php");
            exit();
        }
    }
}
