<?php
include "path.php";
include "app/controllers/topics.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1 ; //если есть параметр page, запишется в переменную page, если ничего нет то будет 1
$limit = 2;
$offset = $limit * ($page - 1);
$total_pages = round(countRow('posts') / $limit, 0);

$posts = selectAffFromPostsWithUsersOnIndex('posts', 'users', $limit, $offset);
$topTopics = selectTopicsFromPosts('posts');
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
<!-- блок карусели -->
<div class="container">
    <div class=row">
        <h2 class="slider-title">Лучшие публикации</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php foreach ($topTopics as $topic): ?>
            <div class="carousel-item active">
                <img src="<?php echo "/images/posts/" . $topic['img']; ?>" alt="<?php echo $topic['title']; ?>" class="d-block w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h5> <a href="<?php echo 'single.php?post=' . $topic['id']; ?>"><?php echo substr($topic['title'], 0, 120); ?></a></h5>
                </div>
            </div>
            <?php endforeach ?>;
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Контент -->
<div class="container">
    <div class="container row">
        <div class="main-content col-md-9 col-12">
            <h2>Последние публикации</h2>
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
            <?php include "app/include/pagination.php" ?>
        </div>
        <!-- sidebar -->
        <div class="sidebar col-md-3 col-12">
            <div class="section search">
                <h3>Поиск</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Поиск...">
                </form>
            </div>
            <div class="section topics">
                <h3>Категории</h3>
                <ul>
                    <?php foreach ($topics as $key => $topic): ?>
                    <li>
                        <a href="<?php echo "categories.php?id=" . $topic['id']; ?>"><?php echo $topic['name']; ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
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
include ('app/include/footer.php');
?>