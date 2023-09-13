<?

include 'path.php';
include SITE_ROOT . '/app/database/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search-term'])) {
    $posts = search_in_title_and_content($_POST['search-term'], 'posts', 'users');
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Search page</title>
    <link rel="stylesheet" href="<?=BASE_URL . 'assets/css/index.css';?>">
    <link rel="stylesheet" href="<?=BASE_URL . 'assets/css/slider.css';?>">
    <link rel="stylesheet" href="<?=BASE_URL . 'assets/css/pagination.css';?>">

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/07764da9c0.js" crossorigin="anonymous"></script>
</head>

<body>

    <? include SITE_ROOT . '/app/include/header.php'; ?>

    <main>
        <div class="container-main">
            <? if (count($posts) > 0) : ?>
                <h2 class="hhr">Результаты поиска</h2>
                <? foreach ($posts as $post) : ?>
                    <div class="row">
                        <div>
                            <div class="img" style="background-image: url('<?= BASE_URL . 'assets/images/' . $post['img']; ?>');">
                                <div>
                                    <h2 class="hhr">
                                        <a class="single_post_title" href="<?= BASE_URL . 'single.php?post=' . $post['id']; ?>"><?= mb_substr($post['title'], 0, 64, 'utf-8') . '...'; ?></a>
                                    </h2>
                                    <ul class="info">
                                        <li>
                                            <? if ($post['admin'] == 1) : ?>
                                                <small><i class="fa-solid fa-user-shield"></i> <?= $post['user_name']; ?></small>
                                            <? else : ?>
                                                <small><i class="fa-solid fa-user-large"></i> <?= $post['user_name']; ?></small>
                                            <? endif; ?>
                                        </li>
                                        <li>
                                            <small><i class="fa-solid fa-calendar"></i> <?= $post['created_date']; ?></small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            <? else : ?>
                <h2 class="hhr">По вашему запросу ничего не найдено</h2>
            <? endif; ?>
        </div>
    </main>
    <? include SITE_ROOT . '/app/include/footer.php'; ?>
</body>

</html>