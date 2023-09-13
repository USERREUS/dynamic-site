<?

include "../../path.php";
include SITE_ROOT . '/app/controls/posts.php';
include SITE_ROOT . '/app/controls/check_reg.php';
include SITE_ROOT . "/app/controls/admin_access.php";

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Admin posts manage page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/admin.css'; ?>">
</head>

<body>
    <? include SITE_ROOT . '/app/include/header_admin.php'; ?>
    <div class="container-admin">
        <div class="row-admin">
            <? include SITE_ROOT . '/app/include/sidebar_admin.php'; ?>
            <main>
                <h2 class="st">Управление постами</h2>
                <hr>
                <div class="table-div">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Название</th>
                                <th scope="col">Автор</th>
                                <th scope="col">Управление</th>
                                <th scope="col">Публикация</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($postsAdm as $key => $post) : ?>
                                <? if ($key % 2 == 1) : ?>
                                    <tr class="odd">
                                    <? else : ?>
                                    <tr>
                                    <? endif; ?>
                                    <td><?= $key + 1; ?></td>
                                    <td>
                                        <?
                                        $temp = $post['title'];
                                        if (strlen($temp) < 64) {
                                            echo $post['title'];
                                        } else {
                                            echo mb_substr($post['title'], 0, 64, 'utf-8') . '...';
                                        }
                                        ?>
                                    </td>
                                    <td><?= $post['user_name']; ?></td>
                                    <td>
                                        <ul class="c4">
                                            <li><a class="c5" href="edit.php?id=<?= $post['id']; ?>">edit</a></li>
                                            <li><a class="c5" href="edit.php?del-id=<?= $post['id']; ?>">delete</a></li>
                                        </ul>
                                    </td>
                                    <td>
                                        <?php if ($post['status']) : ?>
                                            <a class="c5" href="edit.php?pub=0&pub-id=<?= $post['id']; ?>">в черновик</a>
                                        <?php else : ?>
                                            <a class="c5" href="edit.php?pub=1&pub-id=<?= $post['id']; ?>">опубликовать</a>
                                        <?php endif; ?>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a class="btn_2" href="<?= BASE_URL . 'admin/posts/create.php'; ?>">Создать новый пост</a>
            </main>
        </div>
    </div>
</body>

</html>