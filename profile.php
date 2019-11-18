<?php
session_start();
require_once 'handler/profile/profile_change.php';
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
                    <!--                            <li class="nav-item">-->
                    <!--                                <a class="nav-link" href="login.php">Login</a>-->
                    <!--                            </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="handler/auth/logout.php">Выйти</a>
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
                        <div class="card-header"><h3>Профиль пользователя</h3></div>

                        <div class="card-body">

                            <!-- Если успешно выведится флеш сообщение-->
                            <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['success']; ?>
                                </div>
                            <?php endif; ?>

                            <form action="handler/profile/profile_handler.php" method="post"
                                  enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                   id="exampleFormControlInput1"
                                                   value="<?php if (!empty($_SESSION['old_val']['name'])) {
                                                       echo $_SESSION['old_val']['name'];
                                                   } else echo $_SESSION['user']['name']; ?>">

                                            <?php if (isset($_SESSION['err']['name'])) : ?>
                                                <span class="text text-danger">
                                                <?php echo $_SESSION['err']['name'] ?>
                                            </span>
                                            <?php endif; ?>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Email</label>
                                            <input type="name" class="form-control" name="email"
                                                   id="exampleFormControlInput1"
                                                   value="<?php if (!empty($_SESSION['old_val']['email'])) {
                                                       echo $_SESSION['old_val']['email'];
                                                   } else echo $_SESSION['user']['email']; ?>">

                                            <?php if (isset($_SESSION['err']['email'])) : ?>
                                                <span class="text text-danger">
                                                <?php echo $_SESSION['err']['email'] ?>
                                            </span>
                                            <?php endif; ?>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Аватар</label>
                                            <input type="file" class="form-control" name="image"
                                                   id="exampleFormControlInput1">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <img src="
                                                  <?php if (empty($_SESSION['user']['avatar'])) {
                                            echo '/img/no-user.jpg';
                                        } else {
                                            echo 'handler/profile/avatar/' . $_SESSION['user']['avatar'];
                                        }

                                        ?>
                                            " alt="" class="img-fluid">
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-warning">Edit profile</button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Безопасность</h3></div>

                        <div class="card-body">
                            <?php if (isset($_SESSION['success'])): ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['success']; ?>
                                </div>
                            <?php endif; ?>
                            <form action="handler/profile/password_change.php" method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Current password</label>
                                            <input type="password" name="current" class="form-control"
                                                   id="exampleFormControlInput1"
                                                   value="<?php echo $_SESSION['old_val']['current'] ?>">
                                            <?php if (isset($_SESSION['err']['current'])) : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong><?php echo $_SESSION['err']['current']; ?></strong>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">New password</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="exampleFormControlInput1"
                                                   value="<?php echo $_SESSION['old_val']['password'] ?>">
                                            <?php if (isset($_SESSION['err']['password'])) : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong><?php echo $_SESSION['err']['password']; ?></strong>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Password confirmation</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   id="exampleFormControlInput1">
                                            <?php if (isset($_SESSION['err']['password_confirmation'])) : ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <strong><?php echo $_SESSION['err']['password_confirmation']; ?></strong>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                                <?php unset($_SESSION['success']) ?>
                                <?php unset($_SESSION['user']['name']) ?>
                                <?php unset($_SESSION['user']['email']) ?>
                                <?php unset($_SESSION['user']['avatar']) ?>
                                <?php unset($_SESSION['old_val']) ?>
                                <?php unset($_SESSION['err']) ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
