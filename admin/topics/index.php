<?

include "../../path.php";
include SITE_ROOT . '/app/controls/topics.php';
include SITE_ROOT . '/app/controls/check_reg.php';
include SITE_ROOT . '/app/controls/admin_access.php';

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Admin topics manage page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/admin.css'; ?>">
</head>

<body>
    <? include SITE_ROOT . '/app/include/header_admin.php'; ?>
    <div class="container-admin">
        <div class="row-admin">
            <? include SITE_ROOT . '/app/include/sidebar_admin.php'; ?>
            <main>
                <h2 class="st">Управление категориями</h2>
                <hr>
                <div class="table-div">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Название</th>
                                <th scope="col">Управление</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($topics as $key => $topic) : ?>
                                <? if ($key % 2 == 1) : ?>
                                    <tr class="odd">
                                    <? else : ?>
                                    <tr>
                                    <? endif; ?>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $topic['name']; ?></td>
                                    <td>
                                        <ul class="c4">
                                            <li><a class="c5" href="edit.php?id=<?= $topic['id']; ?>">edit</a></li>
                                            <li><a class="c5" href="edit.php?del-id=<?= $topic['id']; ?>">delete</a></li>
                                        </ul>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a class="btn_2" href="<?= BASE_URL . 'admin/topics/create.php'; ?>">Создать новую категорию</a>
            </main>
        </div>
    </div>
</body>

</html>