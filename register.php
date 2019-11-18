<?php
session_start();
//Если пользователь авторизован перенаправим его на главную
if (isset($_SESSION['user']['id'])) {
    header('Location: /');
    exit();
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
<!-- Если успешно выведится флеш сообщение-->
<?php if (isset($_SESSION['info'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['info']; ?>
    </div>
<?php endif; ?>


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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Register</div>

                        <div class="card-body">
                            <form method="POST" action="handler/auth/reg.php">

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                    <div class="col-md-6">
                                        <input
                                                id="name"
                                                type="text"
                                                class="form-control"
                                                name="name"
                                                autofocus
                                                value="<?php echo $_SESSION['old_val']['name']; ?>"
                                        >

                                        <?php if (isset($_SESSION['err']['name'])) : ?>
                                            <div class="alert alert-danger">
                                                <strong><?php echo $_SESSION['err']['name']; ?></strong>
                                            </div>
                                        <?php endif; ?>


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail
                                        Address</label>

                                    <div class="col-md-6">
                                        <input id="email"
                                               type="text"
                                               class="form-control"
                                               name="email"
                                               value="<?php echo $_SESSION['old_val']['email']; ?>"
                                        >
                                        <?php if (isset($_SESSION['err']['email'])) : ?>
                                        <div class="alert alert-danger">
                                            <strong><?php echo $_SESSION['err']['email']; ?></strong>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>


                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password"
                                       type="password"
                                       class="form-control "
                                       name="password"
                                       autocomplete="new-password"
                                       value="<?php echo $_SESSION['old_val']['password']; ?>"
                                >
                                <?php if (isset($_SESSION['err']['password'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong><?php echo $_SESSION['err']['password']; ?></strong>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm"
                                       type="password"
                                       class="form-control"
                                       name="password_confirmation"
                                       autocomplete="new-password"
                                       value="<?php echo $_SESSION['old_val']['password_confirmation']; ?>"
                                >
                                <?php if (isset($_SESSION['err']['password_confirmation'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <strong><?php echo $_SESSION['err']['password_confirmation']; ?></strong>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                        <?php unset($_SESSION['err']); ?>
                        <?php unset($_SESSION['old_val']); ?>
                        <?php unset($_SESSION['info']); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
