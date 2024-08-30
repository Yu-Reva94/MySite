<?php
include('path.php');
include('app/controllers/users.php');

?>
    <!doctype html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/d4b56dc8d3.js" crossorigin="anonymous"></script>
        <title>Мой сайт</title>
    </head>
<body>
<?php
include('app/include/header.php');
?>
    <!-- Начало форма -->
    <div class="container">
        <form class="row" method="post" action="reg.php">
            <h2>Форма регистрации</h2>
            <div class="mb-3 err">
                <p><?php include "app/helps/errorInfo.php" ?></p>
            </div>
            <div class="mb-3 ">
                <label for="exampleFormControlLogin" class="form-label">Введите Логин</label>
                <input type="text" value=" " name="login" value="<?php echo "$login" ?>" class="form-control"
                       id="exampleFormControlLogin" placeholder="Логин">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlEmail" class="form-label">Введите Вашу Эл. почту</label>
                <input type="email" name="mail" value="<?php echo "$email" ?>" class="form-control"
                       id="exampleFormControlEmail"
                       placeholder="@mail.ru">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword" class="form-label">Введите пароль</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword"
                       placeholder="*********">
            </div>
            <div class="mb-3">
                <label for="exampleInputRepeatPassword" class="form-label">Повторите пароль</label>
                <input type="password" name="repeatPassword" class="form-control" id="exampleInputRepeatPassword"
                       placeholder="*********">
            </div>
            <button type="submit" class="btn btn-primary" name="button-reg"><b>Зарегистрироваться</b></button>
            <div class="log">
                <br>
                <a href="log.php">Войти</a>
            </div>
        </form>
    </div>
    <!-- Конец формы -->
    <!-- Footer -->
