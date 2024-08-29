<?php include("path.php");

include "app/controllers/topics.php";
$post = selectOnePostFromPost('posts', 'users', $_GET['post']);
?>
    <!doctype html>
    <html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d4b56dc8d3.js" crossorigin="anonymous"></script>
    <title>Мой сайт</title>
</head>
<body>
<!-- header -->
<?php
include "app/include/header.php";
?>

<!-- Контент -->
<div class="container">
    <div class="container row">
        <div class="main-content col-md-9 col-12">
            <h2><?php echo $post['title'] ?></h2>
            <div class="single_post row">
                <div class="img col-12">
                    <img src="<?php echo "/images/posts/" . $post['img']; ?>" alt="<?php echo $post['title']; ?>"
                         class="img-fluid">
                </div>
                <div class="single_post_text col-12">
                    <i class="fa-solid fa-user"> <?php echo $post['username']; ?></i>
                    <i class="fa-solid fa-calendar"> <?php echo $post['created_date']; ?></i>
                    <p class="preview-text">
                        <?php echo $post['content']; ?>
                    </p>
                    <!-- подключаем комментарии -->
                    <?php include "app/include/comments.php"; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
<!-- Footer -->
<?php
include('app/include/footer.php');
?>