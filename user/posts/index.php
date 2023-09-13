<?

include "../../path.php";
include "../../app/controls/posts.php";

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>User manage page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/user.css'; ?>">
</head>

<body>

    <? include SITE_ROOT . '/app/include/header_user.php'; ?>

    <div class="container-admin">
        <div class="row-admin">

            <? include SITE_ROOT . '/app/include/sidebar_user.php'; ?>

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
                            <?php $i = 0;
                            foreach ($postsAdm as $key => $post) : ?>
                                <? if ($post['user_id'] == $_SESSION['id']) : ?>
                                    <? if ($i % 2 == 1) : $i++; ?>
                                        <tr class="odd">
                                    <? else : ?>
                                        <tr>
                                    <? endif; ?>
                                        <td><?= $i + 1; ?></td>
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
                                    <?php endif; ?>
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