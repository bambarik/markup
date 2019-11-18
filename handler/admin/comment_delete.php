<?php
//Удаление комментария
$pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
$sql = "DELETE FROM comments_users WHERE comments_users.id = :id";
$statement = $pdo->prepare($sql);
$statement->bindParam('id', $_GET['id']);
$statement->execute();
header('Location: /admin.php');
exit();