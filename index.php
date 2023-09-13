<!-- index.php Домашняя страница сайта -->

<?

include 'path.php';
include SITE_ROOT . '/app/controls/topics.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 2;
$offset = $limit * ($page - 1);
$total_posts = count_row('posts');
$total_pages = round($total_posts / $limit, 0, PHP_ROUND_HALF_UP);

$posts = select_all_from_posts_join_users('posts', 'users', $limit, $offset);
$top_posts = select_top_from_posts('posts');

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Home page</title>
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
            <? if (count($top_posts) >= 1) : ?>
                <h2 class="hhr">Топ публикаций</h2>
                <div class="slideshow-container">
                    <div class="row">
                        <div>
                            <? foreach ($top_posts as $post) : ?>
                                <div class="mySlides">
                                    <div class="img" style="background-image: url('<?= BASE_URL . 'assets/images/' . $post['img']; ?>');">
                                        <div>
                                            <h2 class="hhr">
                                                <a class="single_post_title" href="<?= BASE_URL . 'single.php?post=' . $post['id']; ?>"><?= mb_substr($post['title'], 0, 64, 'utf-8') . '...'; ?></a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <a class="prev" onclick="plusSlides(-1)">&#10094</a>
                    <a class="next" onclick="plusSlides(1)">&#10095</a>
                </div>
                <div class="dots-box">
                    <? foreach ($top_posts as $post) : ?>
                        <span class="dot" onclick="currentSlide(<?= $post['id'] + 1; ?>)"></span>
                    <? endforeach; ?>
                </div>
            <? endif; ?>
            <h2 class="hhr">Последние записи</h2>
            <? foreach ($posts as $post) : ?>
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
                                        <li>
                                            <small><i class="fa-solid fa-utensils"></i> <?= $post['place']; ?></small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <? endif; ?>
            <? endforeach; ?>
            <nav class="pagination" aria-label="Pagination">
                <? if ($page > 1) : ?>
                    <a class="pag-btn" href="?page=<?= ($page - 1); ?>">Prev</a>
                <?php endif; ?>
                <? if ($page < $total_pages) : ?>
                    <a class="pag-btn" href="?page=<?= ($page + 1); ?>">Next</a>
                <?php endif; ?>
            </nav>
        </div>
    </main>
    <? include SITE_ROOT . '/app/include/footer.php'; ?>
    <script src="<?= BASE_URL . 'assets/js/scripts.js' ?>"></script>
</body>

</html>