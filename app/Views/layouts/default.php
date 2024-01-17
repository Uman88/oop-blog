<?php

use App\Widgets\MetaWidget;
use App\Widgets\CategoryWidget;

$admin = $_SESSION['user']['email'] ?? null;

?>
<html lang="en" data-bs-theme="dark" data-lt-installed="true">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= MetaWidget::getTitle(); ?></title>

    <link rel="stylesheet" href="<?= CSS . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= CSS . 'bootstrap-icons.min.css' ?>">

</head>
<body>

<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class="navbar-brand" href="/">TITLE</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if ($admin == ADMIN) { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/admin">Главная</a>
                        </li>
                        <?php echo CategoryWidget::dropdown(
                            'Выбрать',
                            CategoryWidget::customItem([
                                'Пользователи' => '/admin/users',
                                'Категории' => '/admin/categories',
                                'Посты' => '/admin/posts',
                            ])
                        );
                    } else { ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Главная</a>
                        </li>
                        <?php echo CategoryWidget::dropdown(
                            'Категории',
                            CategoryWidget::dropdownItem()
                        ); ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/site/about">О нас</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/site/contact">Контакты</a>
                        </li>
                    <?php }
                    ?>
                </ul>
                <div class="d-flex">
                    <?php if (!isset($_SESSION['user'])) : ?>
                        <a class="nav-link " href="/user/login">Войти &nbsp</a>
                        <a class="nav-link " href="/user/registration">Регистрация</a>
                    <?php else: ?>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                            if ($admin == ADMIN) {
                                echo CategoryWidget::dropdown(
                                    'Привет ' . $_SESSION['user']['name'],
                                    CategoryWidget::customItem([
                                        'Админ панель' => '/admin/index',
                                        'Профиль' => '/user/profile',
                                        'Выход' => '/user/logout',
                                    ])
                                );
                            } else {
                                echo CategoryWidget::dropdown(
                                    'Привет ' . $_SESSION['user']['name'],
                                    CategoryWidget::customItem([
                                        'Профиль' => '/user/profile',
                                        'Выход' => '/user/logout',
                                    ])
                                );
                            }
                            ?>
                        </ul>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<main>

    <div class="album py-5 bg-body-tertiary mt-5">
        <div class="container">
            <?= $content; ?>
        </div>
    </div>

</main>

<footer class="text-body-secondary py-5">
    <div class="container">
        <p class="float-end mb-1">
            <a href="#">Back to top</a>
        </p>
        <p class="mb-1">Album example is © Bootstrap, but please download and customize it for yourself!</p>
        <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
                    href="/docs/5.3/getting-started/introduction/">getting started guide</a>.</p>
    </div>
</footer>
<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"
></script>
<script src="<?= JS . 'popper.min.js'; ?>"></script>
<script src="<?= JS . 'bootstrap.min.js'; ?>"></script>
<script src="<?= JS . 'script.js'; ?>"></script>

</body>
</html>