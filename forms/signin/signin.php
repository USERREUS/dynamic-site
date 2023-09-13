<!-- forms/signin/signin.php Файл регистрации на сайте -->

<?php
include '../../path.php';
include SITE_ROOT . '/app/controls/users.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Signin page</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/signin.css'; ?>">
</head>

<body>
    <main>
        <form method="post" action="signin.php">
            <h1>Авторизация</h1>
            <div class="err">
                <!-- Вывод массива с ошибками -->
                <?php include SITE_ROOT . "/app/helps/error_info.php"; ?>
            </div>
            <div class="email-box">
                <input name="email" value="<? if (isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>" type="email" class="email-input" placeholder="email@example.com">
            </div>
            <div class="pass-box">
                <input name="pass" value="<? if (isset($_COOKIE['pass'])) echo $_COOKIE['pass']; ?>" type="password" class="pass-input" placeholder="password">
            </div>
            <div class="form-checkbox">
                <? if (isset($_COOKIE['save'])) : ?>
                    <input name="save" type="checkbox" class="checkbox" id="same-address" checked>
                <? else : ?>
                    <input name="save" type="checkbox" class="checkbox" id="same-address">
                <? endif; ?>
                <label class="form-check-label" for="same-address">Сохранить данные</label>
            </div>
            <button name="button-log" class="submit" type="submit">Войти</button>
            <a class="submit" href="<?= BASE_URL . "/forms/login/login.php?" ?>">Регистрация</a>
            <a class="submit on_main_btn" href="<?= BASE_URL . "/index.php"; ?>">На главную</a>
        </form>
    </main>
</body>

</html>