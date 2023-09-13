<?

include 'path.php';
include SITE_ROOT . '/app/controls/topics.php';

$posts = select_all_from_posts_with_users('posts', 'users');
$category = select_one('topics', ['id' => $_GET['id']]);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Category page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/index.css'; ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/slider.css'; ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/pagination.css'; ?>">

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
        <? include SITE_ROOT . '/app/include/sidebar.php'; ?>
        <div class="container-main">
            <h2 class="hhr">Статьи в категории: <b><?= $category['name']; ?></b></h2>
            <? foreach ($posts as $post) : ?>
                <? if ($post['id_topic'] == $category['id']) : ?>
                    <? if ($post['status'] == 1) : ?>
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
                    <? endif; ?>
                <? endif; ?>
            <? endforeach; ?>
        </div>
    </main>
    <? include SITE_ROOT . '/app/include/footer.php'; ?>
</body>

</html>