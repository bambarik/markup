<?php
//Редактирование профиля
session_start();
$_SESSION['old_val'] = $_POST;

if (isset($_SESSION['user']['id'])) {
    $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
    $sql = "SELECT * FROM users WHERE (name = :name || email = :email) AND id != :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam('name', $_POST['name']);
    $statement->bindParam('email', $_POST['email']);
    $statement->bindParam('id', $_SESSION['user']['id']);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    if ($result[0]['name'] == $_POST['name']) {
        $_SESSION['err']['name'] = 'Пользователь ' . $_POST['name'] . ' уже существует';
        header('Location: /profile.php');
        exit();
    }

    if ($result[0]['email'] == $_POST['email']) {
        $_SESSION['err']['email'] = 'Пользователь ' . $_POST['email'] . ' уже существует';
        header('Location: /profile.php');
        exit();
    }

    if (!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        $_SESSION['err']['email'] = 'Неккоретно введен email';
        header('Location: /profile.php');
        exit();
    }
}


$data = [
    'id' => $_SESSION['user']['id'],
    'name' => $_POST['name'],
    'email' => $_POST['email']
];

if (empty($_FILES['image']['name'])) {
    $data = [
        'id' => $_SESSION['user']['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email']
    ];

    $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
    $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    header('Location: /profile.php');
    $_SESSION['success'] = 'Профиль успешно обновлен';
} else {
    $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
    $sql = "SELECT  * FROM users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->bindParam('id', $_SESSION['user']['id']);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $file = $result[0]['avatar'];

    if (!empty($file)) {
        if (file_exists('avatar/' . $file)) {
            unlink('avatar/' . $file);
        }

    }

    $path = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    move_uploaded_file($_FILES['image']['tmp_name'], 'avatar/' . $path);

    $data = [
        'id' => $_SESSION['user']['id'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'avatar' => $path
    ];

    $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
    $sql = "UPDATE users SET name = :name, email = :email, avatar = :avatar WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    header('Location: /profile.php');
    $_SESSION['success'] = 'Профиль успешно обновлен';

}



