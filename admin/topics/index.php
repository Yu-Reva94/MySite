<?php session_start();
include "../../path.php";
include "../../app/controllers/topics.php";
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
        <div class="button row">
            <a href="created.php" class="btn btn-success col-2">Создать</a>
            <span class="col-1"></span>
            <a href="index.php" class="btn btn-danger col-2">Изменить</a>
        </div>

        <!-- таблица -->
        <div class="row title-table">
            <h2>Управление категориями</h2>
            <div class="col-1">ID</div>
            <div class="col-5">Название</div>
            <div class="col-4">Управление</div>
        </div>
        <?php foreach ($topics as $key => $topic): ?>
            <div class="row post">
                <div class="id col-1"><?php echo $key + 1; ?></div>
                <div class="title col-5"><?php echo $topic['name']; ?></div>
                <div class="red col-2 custom-edit"><a href="edit.php?id=<?php echo $topic['id']; ?>">Edit</a></div>
                <div class="del col-2 custom-del"><a href="edit.php?del_id=<?php echo $topic['id']; ?>">Delete</a></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->

