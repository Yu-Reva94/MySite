<?php
include "../../path.php";
include "../../app/controllers/commentaries.php"
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
            <h2>Управление комментариями</h2>
            <div class="col-1">ID</div>
            <div class="col-5">Комментарий</div>

            <div class="col-2">Автор</div>
            <div class="col-4">Управление</div>
        </div>
        <?php foreach ($commentsForAdm as $key => $comment): ?>
            <div class="post row">
                <div class="id col-1"><?php echo $comment['id']; ?></div>
                <div class="title col-5"><?php echo substr($comment['comment'],0, 120); ?></div>
                <?php
                $user = $comment['email'];
                $user =explode('@', $user);
                $user=$user[0];
                ?>
                <div class="author col-2"><?php echo $user . '@'; ?></div>
                <div class="ed col-1 custom-edit"><a href="edit.php?id=<?php echo $comment['id']; ?>">Edit</a></div>
                <div class="del col-1 custom-del"><a href="edit.php?del_id=<?php echo $comment['id']; ?>">Delete</a>
                </div>
                <!-- проверка опубликована ли статья -->
                <?php if ($comment['status']): ?>
                    <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?php echo $comment['id']; ?>">В
                            черновик</a></div>
                <?php else: ?>
                    <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?php echo $comment['id']; ?>">Опубликовать</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->

