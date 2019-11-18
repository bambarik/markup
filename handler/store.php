<?php
session_start();
//
//$commUser = $_POST['name'];
//$commText = $_POST['text'];
//$pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
//$sql = "INSERT INTO comments_users (name, text) VALUES ('$commUser', '$commText')";
//$statement = $pdo->query($sql);
//header('Location: /');

//$commUser = $_POST['name'];
//$commText = $_POST['text'];
//$pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
//$sql = "INSERT INTO comments_users (name, text) VALUES (:name, :text)";
//$statement = $pdo->prepare($sql);
//$statement->bindParam(':name', $commUser);
//$statement->bindParam(':text', $commText);
//$statement->execute();
//header ('Location: /');

//Добавление комментария
$data = [
    'user_id' => $_SESSION['user']['id'],
    'text' => $_POST['text'],
    'date' => time()
];
$_SESSION['old_val'] = $_POST;

if (empty($_POST['text'])) {
    $_SESSION['err']['text'] = 'Введите сообщение';
    header('Location: /');
    exit();
}
else {
    $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
    $sql = "INSERT INTO comments_users (user_id, text, date) VALUES (:user_id, :text, :date)";
    $statement = $pdo->prepare($sql);
    $statement->execute($data);
    $_SESSION['success'] = 'Комментарий добавлен';
    unset($_SESSION['old_val']);
    header('Location: /');
    exit();
}




