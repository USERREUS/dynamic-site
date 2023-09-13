<!-- admin/index.php Домашняя страница администратора -->

<?

include "../path.php";
include "../app/controls/posts.php";
include SITE_ROOT . '/app/controls/check_reg.php';
include SITE_ROOT . "/app/controls/admin_access.php";

$posts = select_all_from_posts_with_users('posts', 'users');

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/admin.css'; ?>">
    <!-- Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/07764da9c0.js" crossorigin="anonymous"></script>
</head>

<body>
    <? include SITE_ROOT . '/app/include/header_admin.php'; ?>
    <div class="container-admin">
        <div class="row-admin">
            <? include SITE_ROOT . '/app/include/sidebar_admin.php'; ?>
            <main>
                <h2 class="st">Мои посты</h2>
                <hr>
                <? foreach ($posts as $post) : ?>
                    <? if ($post['user_id'] == $_SESSION['id']) : ?>
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
                                                    <small><i class="fa-solid fa-user-shield"></i> <?= $post['user_name']; ?></small>
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
                    <? endif; ?>
                <? endforeach; ?>
            </main>
        </div>
    </div>
</body>

</html>