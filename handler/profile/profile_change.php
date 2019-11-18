<?php
//Текущие значения пользователя

session_start();

$pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
$sql = "SELECT * FROM users WHERE id = :id";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $_SESSION['user']['id']]);
$result = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!empty($result[0]['name'])) {
    $_SESSION['user']['name'] = $result[0]['name'];
}

if (!empty($result[0]['email'])) {
    $_SESSION['user']['email'] = $result[0]['email'];
}

if (!empty($result[0]['avatar'])) {
    $_SESSION['user']['avatar'] = $result[0]['avatar'];
}

