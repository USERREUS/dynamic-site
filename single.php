<?

include 'path.php';
include SITE_ROOT . '/app/controls/topics.php';

$post = select_one_from_posts_join_users_topics('posts', 'users', 'topics', $_GET['post']);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Single page</title>
    <link rel="stylesheet" href="<?=BASE_URL . 'assets/css/single.css';?>">

    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/07764da9c0.js" crossorigin="anonymous"></script>
</head>

<body>
    <? include SITE_ROOT . '/app/include/header.php'; ?>
    <main class="single-post">
        <div class="img" style="background-image: url('<?= BASE_URL . 'assets/images/' . $post['img']; ?>')">
        </div>
        <div class="place">
            <div class="post">
                <h3>
                    Категория записи: <?= $post['name']; ?>
                </h3>

                <article>
                    <h2 class="title"><?= $post['title']; ?></h2>
                    <p class="meta">Created <?= $post['created_date']; ?> by <?= $post['user_name'] ?></p>
                    <?= $post['content']; ?>
                </article>
            </div>
        </div>
    </main>
    <? include SITE_ROOT . '/app/include/footer.php'; ?>
</body>

</html>