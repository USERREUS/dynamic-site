<?

include "../../path.php";
include "../../app/controls/users.php";
include SITE_ROOT . '/app/controls/check_reg.php';
include SITE_ROOT . "/app/controls/admin_access.php";

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Admin users manage page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/admin.css'; ?>">
</head>

<body>
    <? include SITE_ROOT . '/app/include/header_admin.php'; ?>
    <div class="container-admin">
        <div class="row-admin">
            <? include SITE_ROOT . '/app/include/sidebar_admin.php'; ?>
            <main>
                <h2 class="st">Управление пользователями</h2>
                <hr>
                <div class="table-div">
                    <table class="table-data">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Логин</th>
                                <th scope="col">Email</th>
                                <th scope="col">Роль</th>
                                <th scope="col">Управление</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($users as $key => $user) : ?>
                                <? if ($key % 2 == 1) : ?>
                                    <tr class="odd">
                                    <? else : ?>
                                    <tr>
                                    <? endif; ?>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $user['user_name']; ?></td>
                                    <td><?= $user['email']; ?></td>
                                    <td>
                                        <? if ($user['admin'] == 1) : ?>
                                            Админ
                                        <?php else : ?>
                                            Пользователь
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <ul class="c4">
                                            <li><a class="c5" href="edit.php?edit-id=<?= $user['id']; ?>">edit</a></li>
                                            <li><a class="c5" href="edit.php?del-id=<?= $user['id']; ?>">delete</a></li>
                                        </ul>
                                    </td>
                                    </tr>
                                <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a class="btn_2" href="<?= BASE_URL . 'admin/users/create.php'; ?>">Создать нового пользователя</a>
            </main>
        </div>
    </div>
</body>

</html>