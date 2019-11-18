<?php
$pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
$sql = "SELECT users.name, users.avatar, comments_users.text, comments_users.date, comments_users.id, comments_users.ban
        FROM comments_users LEFT JOIN users ON users.id = comments_users.user_id WHERE comments_users.ban = 0
        ORDER BY comments_users.id DESC "; // Выбрать столбцы из таблиц, из таблицы comments_users, Объеденить с таблицей users, Выбираем поле где users.id = comments_users.user_id
$statement = $pdo->prepare($sql);
$statement->execute();
$comUsers = $statement->fetchAll(PDO::FETCH_ASSOC);