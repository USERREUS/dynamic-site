<?php
include '../../path.php';
include SITE_ROOT . '/app/controls/users.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Admin users edit page</title>
  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/post.css'; ?>">
</head>

<body>
  <div class="container">
    <main>
      <div class="row">
        <div class="form-place">
          <h4>Редактирование пользователя</h4>
          <div class="err">
            <!-- Вывод массива с ошибками -->
            <?php include SITE_ROOT . "/app/helps/error_info.php"; ?>
          </div>
          <hr>
          <form action="create.php" method="post" enctype="multipart/form-data">
            <div>
              <input type="hidden" name="id" value="<?= $id; ?>">
              <div class="inp-box">
                <label for="name" class="form-label">Логин</label>
                <input value="<?= $login ?>" name="login" type="text" class="inp" id="name" placeholder="Имя пользователя" required>
              </div>
              <div class="inp-box">
                <label for="email" class="form-label">Email</label>
                <input value="<?= $email ?>" name="email" type="email" class="inp" id="email" placeholder="****@mail.com" required>
              </div>
              <div class="inp-box">
                <label for="pass" class="form-label">Пароль</label>
                <input name="pass" type="password" class="inp" id="pass" placeholder="Введите новый пароль" required>
              </div>
              <div class="inp-box">
                <label for="pass_rep" class="form-label">Пароль</label>
                <input name="pass_rep" type="password" class="inp" id="pass_rep" placeholder="Повторите пароль" required>
              </div>
            </div>
            <hr>
            <div class="form-check">
              <? if ($admin == 1) : ?>
                <input name="admin" value="1" type="checkbox" class="checkbox" id="admin" checked>
              <? else : ?>
                <input name="admin" value="1" type="checkbox" class="checkbox" id="admin">
              <? endif ?>
              <label class="form-check-label" for="admin">Администратор / пользователь</label>
            </div>
            <hr>
            <ul class="c4">
              <li><button name="edit-user" type="submit">Обновить пользователя</button></li>
              <li><a href="<?= BASE_URL . 'index.php'; ?>" class="c5">На главую</a></li>
            </ul>
          </form>
        </div>
      </div>
    </main>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <script src="<?= BASE_URL . 'assets/js/CKE.js'; ?>"></script>
</body>

</html>