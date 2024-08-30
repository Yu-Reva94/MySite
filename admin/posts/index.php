<?php
include "../../path.php";
include "../../app/controllers/posts.php"
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
            <span class="mb-1"></span>
            <a href="created.php" class="btn btn-success col-2">Создать</a>
        </div>
        <div class="row title-table">
            <h2>Управление записями</h2>
            <div class="col-1">ID</div>
            <div class="col-3">Название</div>

            <div class="col-2">Автор</div>
            <div class="col-6">Управление</div>
        </div>
        <?php foreach ($postsAdm as $key => $post): ?>
            <div class="post row">
                <div class="id col-1"><?php echo $key + 1; ?></div>
                <div class="title col-3"><?php echo substr($post['title'],0, 120); ?></div>
                <div class="author col-2"><?php echo $post['username']; ?></div>
                <div class="ed col-2 custom-edit"><a href="editPosts.php?id=<?php echo $post['id']; ?>">Edit</a></div>
                <div class="del col-2 custom-del"><a href="editPosts.php?del_id=<?php echo $post['id']; ?>">Delete</a>
                </div>
                <!-- проверка опубликована ли статья -->
                <?php if ($post['status']): ?>
                    <div class="status col-2"><a href="editPosts.php?publish=0&pub_id=<?php echo $post['id']; ?>">В
                            черновик</a></div>
                <?php else: ?>
                    <div class="status col-2"><a href="editPosts.php?publish=1&pub_id=<?php echo $post['id']; ?>">Опубликовать</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Footer -->

