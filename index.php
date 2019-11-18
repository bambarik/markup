<?php
session_start();
require 'handler/comments_select.php';
// 1. Мы авторизовываемся, занесли куки(email и password), и создали сессию $_SESSION['user']['id'] в бразуер
// 2. Мы авторизовались, но после закрытия браузера сессия удаляется
// 3. Чтобы мы могли вытаскивать данные о пользователе, необходимо вновь создать сессию
// 4. Получается что мы используем похожую форму аторизации, только теперь значения из базы сравниваем с куками, а не с $_POST
if (!isset($_SESSION['user']['id'])) {
    if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        $pdo = new PDO('mysql:host=localhost;dbname=markup;charset=utf8', 'root', '');
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $statement = $pdo->prepare($sql);
        $statement->bindParam('email', $_COOKIE['email']);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($result[0]['password'] == $_COOKIE['password'] && $_COOKIE['email'] == $result[0]['email']) {
            setcookie("email", $_COOKIE['email'], time() + 345600, "/");
            setcookie("password", $_COOKIE['password'], time() + 345600, "/");
            $_SESSION['user']['id'] = $result[0]['id'];
            header('Location: /');
            exit();
        } else {
            $_SESSION['warning'] = 'Неверные email или пароль';
            header("Location: /login.php");
            exit();
        }
    }
}

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

                    <?php if (isset($_SESSION['user']['id'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="handler/auth/logout.php">logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Комментарии</h3></div>

                        <div class="card-body">
                            <!-- Если успешно выведится флеш сообщение-->
                            <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['success']; ?>
                                </div>
                            <?php endif; ?>

                            <!--Вывод комментариев пользователей-->
                            <?php foreach ($comUsers as $comUser) : ?>
                                <div class="media">
                                        <img src="
                                            <?php if (empty($comUser['avatar'])) {
                                                echo '/img/no-user.jpg';
                                            } else {
                                                echo 'handler/profile/avatar/' . $comUser['avatar'];
                                            }
                                            ?>
                                        "
                                         class="mr-3"
                                         alt="..." width="64"
                                         height="64">
                                    <div class="media-body">
                                        <h5 class="mt-0">
                                            <?php if ($comUser['name'] == NULL) echo 'Пользователь удален'; else echo $comUser['name']; ?>
                                        </h5>
                                        <span>
                                            <small>
                                                <?php echo date('d/m/Y/G:i', $comUser['date']); ?>
                                            </small>
                                        </span>
                                        <p>
                                            <?php echo $comUser['text']; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <!--Если пользователь авторизирован может оставлять комментарии-->
                <?php if (isset($_SESSION['user']['id'])) : ?>
                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-header">
                                <h3>
                                    Оставить комментарий
                                </h3>
                            </div>
                            <div class="card-body">
                                <form action="handler/store.php" method="post">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Сообщение</label>

                                        <!-- Если ошибка выведится флеш сообщение-->
                                        <?php if (isset($_SESSION['err']['text'])): ?>
                                            <div class="alert alert-danger" role="alert">
                                                <?php echo $_SESSION['err']['text']; ?>
                                            </div>
                                        <?php endif; ?>

                                        <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php echo $_SESSION['old_val']['text']; ?></textarea>
                                        <?php
                                        unset($_SESSION['err']);
                                        unset($_SESSION['success']);
                                        unset($_SESSION['old_val']);
                                        ?>
                                    </div>
                                    <button type="submit" class="btn btn-success">Отправить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-success" role="alert">
                        <a href="login.php">Авторизируйтесь</a>, чтобы оставить комментарий
                    </div>
                <?php endif ?>
            </div>
        </div>
    </main>
</div>
</body>
</html>
