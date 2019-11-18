<?php
//Регистрация пользователя
session_start();

$_SESSION['old_val'] = $_POST;
if (empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['password']) ||
    empty($_POST['password_confirmation'])) {
    if (empty($_POST['name'])) {
        $_SESSION['err']['name'] = 'Заполните поле Name';
    }
    if (empty($_POST['email'])) {
        $_SESSION['err']['email'] = 'Заполните поле E-mail';;
    }
    if (empty($_POST['password'])) {
        $_SESSION['err']['password'] = 'Придумайте и введите Пароль';
    }
    if (empty($_POST['password_confirmation'])) {
        $_SESSION['err']['password_confirmation'] = 'Повторно введите Пароль';
    }
    header('Location: /register.php');
    exit();
}
if (strlen($_POST['password']) < 6) {
    $_SESSION['err']['password'] = 'Пароль должен содержать не менее 6 символов';
    header('Location: /register.php');
    exit();
}
if ($_POST['password'] != $_POST['password_confirmation']) {
    $_SESSION['err']['password_confirmation'] = 'Пароли не совпадают';
    header('Location: /register.php');
    exit();
}

if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
    $_SESSION['err']['email'] = 'Неккоретно введен email';
    header('Location: /register.php');
    exit();
}
if (!empty($_POST['name']) || !empty($_POST['email'])) {
    $pdo = new PDO("mysql:host=localhost;dbname=markup;charset=utf8", "root", "");
    $sql = "SELECT * FROM users WHERE name = :name OR email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':name', $_POST['name']);
    $statement->bindParam(':email', $_POST['email']);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($result[0]['name'] == $_POST['name']) {
        $_SESSION['err']['name'] = 'Пользователь уже существует';
        header('Location: /register.php');
        exit();
    }
    if ($result[0]['email'] == $_POST['email']) {
        $_SESSION['err']['email'] = 'email уже существует';
        header('Location: /register.php');
        exit();
    }
}

$pdo = new PDO("mysql:host=localhost;dbname=markup;charset=utf8", "root", "");
$sql = "INSERT INTO users (name, email, password, password_confirmation) VALUES (:name, :email, :password, :password_confirmation)";
$statement = $pdo->prepare($sql);
$statement->bindParam(':name', $_POST['name']);
$statement->bindParam(':email', $_POST['email']);
$statement->bindParam(':password', password_hash($_POST['password'], PASSWORD_DEFAULT));
$statement->bindParam(':password_confirmation', password_hash($_POST['password_confirmation'], PASSWORD_DEFAULT));
$result = $statement->execute();
header('Location: /login.php');
unset($_SESSION['old_val']);
exit();













