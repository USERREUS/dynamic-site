<?php
include '../../path.php';
include SITE_ROOT . '/app/controls/users.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Admin users create page</title>
  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/post.css'; ?>">
</head>

<body>
  <div class="container">
    <main>
      <div class="row">
        <div class="form-place">
          <h4>Создание пользователя</h4>
          <div class="err">
            <!-- Вывод массива с ошибками -->
            <?php include SITE_ROOT . "/app/helps/error_info.php"; ?>
          </div>
          <hr>
          <form action="create.php" method="post" enctype="multipart/form-data">
            <div>
              <div class="inp-box">
                <label for="name" class="form-label">Логин</label>
                <input name="login" type="text" class="inp" id="name" placeholder="Имя пользователя" required>
              </div>
              <div class="inp-box">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" class="inp" id="email" placeholder="****@mail.com" required>
              </div>
              <div class="inp-box">
                <label for="pass" class="form-label">Пароль</label>
                <input name="pass" type="password" class="inp" id="pass" placeholder="Введите пароль" required>
              </div>
              <div class="inp-box">
                <label for="pass_rep" class="form-label">Пароль</label>
                <input name="pass_rep" type="password" class="inp" id="pass_rep" placeholder="Повторите пароль" required>
              </div>
            </div>
            <hr>
            <div class="form-check">
              <input name="admin" value="1" type="checkbox" class="checkbox" id="admin">
              <label class="form-check-label" for="admin">Администратор / пользователь</label>
            </div>
            <hr>
            <ul class="c4">
              <li><button name="create-user" type="submit">Создать пользователя</button></li>
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