<?php
//Изменение пароля у пользователя

session_start();
$_SESSION['old_val'] = $_POST;
if (isset($_SESSION['user']['id'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
    $sql = "SELECT password FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam('id', $_SESSION['user']['id']);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (empty($_POST['current']) || empty($_POST['password']) || empty($_POST['password_confirmation'])) {
        if (empty($_POST['current'])) {
            $_SESSION['err']['current'] = 'Заполните поле';
        }
        if (empty($_POST['password'])) {
            $_SESSION['err']['password'] = 'Заполните поле';
        }
        if (empty($_POST['password_confirmation'])) {
            $_SESSION['err']['password_confirmation'] = 'Заполните поле';
        }
        header('Location: /profile.php');
    }

    if (!empty($_POST['current'])) {
        if ($result[0]['password'] == password_verify($_POST['current'], $result[0]['password'])) {
            if (strlen($_POST['password']) < 6) {
                $_SESSION['err']['password'] = 'Пароль должен содержать не менее 6 символов';
                header('Location: /profile.php');
                exit();
            }
            if ($_POST['password'] != $_POST['password_confirmation']) {
                $_SESSION['err']['password_confirmation'] = 'Пароли не совпадают';
                header('Location: /profile.php');
                exit();
            }
            $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
            $sql = "UPDATE users SET password = :password, password_confirmation = :password_confirmation WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->bindParam('password', password_hash($_POST['password'], PASSWORD_DEFAULT));
            $statement->bindParam('password_confirmation', password_hash($_POST['password_confirmation'], PASSWORD_DEFAULT));
            $statement->bindParam('id', $_SESSION['user']['id']);
            $statement->execute();
            header('Location: /profile.php');
            $_SESSION['success'] = 'Пароль успешно обновлен';
            exit();
        }
        else {
            $_SESSION['err']['current'] = "Старый пароль введен не верно";
            header('Location: /profile.php');
            exit();
        }
    }
}
