<?php
//Запретить комментарий
$pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
$sql = "UPDATE comments_users SET ban = 1 WHERE comments_users.id = :id";
$statement = $pdo->prepare($sql);
$statement->bindParam('id', $_GET['id']);
$statement->execute();
header('Location: /admin.php');
exit();