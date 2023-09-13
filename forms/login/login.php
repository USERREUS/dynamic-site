<!-- forms/login/login.php Файл входа на сайт -->

<?php
include '../../path.php';
include SITE_ROOT . '/app/controls/users.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Login page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/login.css'; ?>">
</head>

<body>
    <main>
        <form action="login.php" method="post">
            <h1>Регистрация</h1>
            <div class="err">
                <!-- Вывод массива с ошибками -->
                <?php include SITE_ROOT . "/app/helps/error_info.php"; ?>
            </div>
            <div class="box">
                <input name="email" value="<?= $email; ?>" type="email" class="down-input" placeholder="email@example.com">
            </div>
            <div class="box">
                <input name="login" value="<?= $login; ?>" type="text" class="down-input" placeholder="login">
            </div>
            <div class="box">
                <input name="pass" type="password" class="down-input" placeholder="password">
            </div>
            <div class="box">
                <input name="pass_rep" type="password" class="down-input" placeholder="repeat password">
            </div>
            <button name="button-reg" class="submit" type="submit">Зарегистрироваться</button>
            <a class="submit" href="<?= BASE_URL . "/forms/signin/signin.php?" ?>">Авторизация</a>
            <a class="submit on_main_btn" href="<?= BASE_URL . "/index.php"; ?>">На главную</a>
        </form>
    </main>
</body>

</html>