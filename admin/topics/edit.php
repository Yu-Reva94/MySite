<?php session_start();
include "../../path.php";
include "../../app/controllers/topics.php"
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/admin.css">
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
        <div class="button row">
            <a href="created.php" class="btn btn-success col-2">Создать</a>
            <span class="col-1"></span>
            <a href="index.php" class="btn btn-danger col-2">Изменить</a>
        </div>
        <div class="row title-table">
            <h2>Редактирование категории</h2>
        </div>
        <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
                <!-- <p><?php // echo "$errMsg" ?></p> -->
            </div>
            <form action="edit.php" method="post">
                <input name="id" value="<?php echo $id ?>" type="hidden">
                <div class="col">
                    <input type="text" name="name" value="<?php echo $name ?>" class="form-control"
                           placeholder="Имя категории" aria-label="Имя категории">
                </div>
                <div class="col">
                    <label for="content" class="form-label">Описание категории</label>
                    <textarea name="description" class="form-control" id="content"
                              rows="6"><?php echo $description ?></textarea>
                </div>
                <div class="col">
                    <button name="topic-edit" class="btn btn-primary" type="submit">Обновить</button>
                </div>
            </form>
        </div>

    </div>
</div>
    <!-- footer -->
