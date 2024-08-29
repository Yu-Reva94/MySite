<?php
require_once('path.php');
?>

<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="<?php echo BASE_URL ?>">Мой сайт</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Главная</a></li>
                    <li><a href="<?php echo BASE_URL . 'about.php' ?>">О нас</a></li>
                    <li>
                        <?php if (isset($_SESSION['id'])): ?>
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <? echo $_SESSION['login']; ?>
                            </a>
                            <ul>
                                <?php if ($_SESSION['admin']): ?>
                                    <li><a href="admin/admin.php">Админ панель</a></li>
                                <?php endif ?>
                                <li><a href="logout.php">Выйти</a></li>
                            </ul>
                        <?php else: ?>
                            <a href="log.php">
                                <i class="fa fa-user"></i>
                                Войти
                            </a>
                            <ul>
                                <li><a href="reg.php">Зарегистрироваться</a></li>
                            </ul>
                            </a>
                        <?php endif ?>

                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>