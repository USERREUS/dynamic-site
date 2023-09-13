<?php
include '../../path.php';
include SITE_ROOT . '/app/controls/topics.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Admin topics edit page</title>
  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/post.css'; ?>">
</head>

<body>
  <div class="container">
    <main>
      <div class="row">
        <div class="form-place">
          <h4>Создание категории</h4>
          <div class="err">
            <!-- Вывод массива с ошибками -->
            <?php include SITE_ROOT . "/app/helps/error_info.php"; ?>
          </div>
          <hr>
          <form action="create.php" method="post" enctype="multipart/form-data">
            <div>
              <input name="id" value="<?= $id; ?>" type="hidden">
              <div class="inp-box">
                <label for="title" class="form-label">Название</label>
                <input value="<?= $name; ?>" name="name" type="text" class="inp" id="title" placeholder="Заголовок поста" required>
              </div>
              <div class="inp-box">
                <label for="editor" class="form-label">Описание</label>
                <textarea name="description" class="inp" id="editor"><?= $descr; ?></textarea>
              </div>
            </div>
            <hr>
            <ul class="c4">
              <li><button name="topic-edit" type="submit">Обновить категорию</button></li>
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