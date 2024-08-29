<?php
include 'path.php';
include "app/database/db.php";
$errSearch = '';
($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term']));
if ($posts = searchInTitleAndContent($_POST['search-term'], 'posts', 'users')) {
}else{
        $errSearch = "По данному запросу ничего не найдено";
}
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
include('app/include/header.php');
?>
<!-- Контент -->
<div class="container">
    <div class="container row">
        <div class="main-content col-12">
            <h2>Результаты поиска</h2>
            <p><?php echo $errSearch ?></p>
            <?php foreach ($posts as $post): ?>
                <div class="post row">
                    <div class="img col-3 com-md-8">
                        <img src="<?php echo "/images/posts/" . $post['img']; ?>" alt="<?php echo $post['title']; ?>"
                             class="img-fluid">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="<?php echo 'single.php?post=' . $post['id']; ?>"><?php echo substr($post['title'], 0, 120); ?></a>
                        </h3>
                        <i class="fa-solid fa-user"> <?php echo $post['username']; ?></i>
                        <i class="fa-solid fa-calendar"> <?php echo $post['created_date']; ?></i>
                        <p class="preview-text">
                            <?php echo substr($post['content'], 0, 120); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- sidebar -->

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
<!-- Footer -->
