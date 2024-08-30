<?php session_start();
include "../../path.php";
include "../../app/controllers/users.php";
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d4b56dc8d3.js" crossorigin="anonymous"></script>
    <title>Мой сайт</title>
</head>
<body>
<!-- header -->
<?php
include('../../app/include/header-admin.php');
?>
<div class="container">
    <?php
    include('../../app/include/sidebar-admin.php');
    ?>
    <div class="col-1"></div>
    <div class="posts col-8">
        <div class="row title-table">
            <h2>Создать пользователя</h2>
            <div class="mb-12 col-12 col-mb12 err">
                <p><?php include "../../app/helps/errorInfo.php"; ?></p>
            </div>
        </div>
        <div class="row add-post">
            <form action="created.php" method="post">
                <div class="col">
                    <div class="mb-3 ">
                        <label for="exampleFormControlLogin" class="form-label">Логин</label>
                        <input type="text" value=" " name="login" value="<?php echo "$login" ?>" class="form-control"
                               id="exampleFormControlLogin" placeholder="Логин">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlEmail" class="form-label">Эл. почта</label>
                        <input type="email" name="mail" value="<?php echo "$email" ?>" class="form-control"
                               id="exampleFormControlEmail"
                               placeholder="@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword" class="form-label">Введите пароль</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword"
                               placeholder="*********">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputRepeatPassword" class="form-label">Повторите пароль</label>
                        <input type="password" name="repeatPassword" class="form-control"
                               id="exampleInputRepeatPassword"
                               placeholder="*********">
                    </div>
                    <input name="admin" type="checkbox" value="1" id="adminCheck">
                    <label>Админ</label>
                    <button name="create-user" class="btn btn-primary" type="submit">Создать</button>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Footer -->
