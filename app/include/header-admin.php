<?php
require_once('../../path.php');
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
                    <li>
                    <?php if (isset($_SESSION['id'])): ?>
                        <a href="#">
                            <i class="fa fa-user"></i>
                            <?php echo $_SESSION['login']; ?>
                        </a>
                        <ul>
                            <li><a href="../../logout.php">Выйти</a></li>
                        </ul>
                    <?php endif ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>