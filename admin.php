<?php
require 'handler/admin/comment_all.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                Project
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Админ панель</h3></div>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Аватар</th>
                                    <th>Имя</th>
                                    <th>Дата</th>
                                    <th>Комментарий</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>

                                <tbody>
                                <!--Получение всех комментариев и их обработка-->
                                <?php foreach ($comUsers as $comUser) : ?>
                                    <tr>
                                        <td>
                                            <img src="<?php if (empty($comUser['avatar'])) {
                                                echo '/img/no-user.jpg';
                                            } else {
                                                echo 'handler/profile/avatar/' . $comUser['avatar'];
                                            }

                                            ?>"
                                                 alt="" class="img-fluid" width="64" height="64">
                                        </td>
                                        <td><?php if ($comUser['name'] == NULL) echo 'Пользователь удален'; else echo $comUser['name']; ?></td>
                                        <td><?php echo date('d/m/Y/G:i', $comUser['date']); ?></td>
                                        <td><?php echo $comUser['text']; ?></td>
                                        <td>
                                            <?php if ($comUser['ban'] == 1) : ?>
                                                <a href="handler/admin/allow.php?id=<?php echo $comUser['id'] ?>"
                                                   class="btn btn-success">Разрешить</a>
                                            <?php else : ?>
                                                <a href="handler/admin/ban.php?id=<?php echo $comUser['id'] ?>"
                                                   class="btn btn-warning">Запретить</a>
                                            <?php endif ?>
                                            <a href="handler/admin/comment_delete.php?id=<?php echo $comUser['id'] ?>"
                                               onclick="return confirm('are you sure?')"
                                               class="btn btn-danger">Удалить</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
