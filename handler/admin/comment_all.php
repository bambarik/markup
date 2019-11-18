<?php
//Получение всех комментариев
$pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
$sql = "SELECT users.name, users.avatar, comments_users.text, comments_users.date, comments_users.id, comments_users.ban
        FROM comments_users LEFT JOIN users ON users.id = comments_users.user_id
        ORDER BY comments_users.id DESC ";
$statement = $pdo->prepare($sql);
$statement->execute();
$comUsers = $statement->fetchAll(PDO::FETCH_ASSOC);