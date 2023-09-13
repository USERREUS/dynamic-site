<?php
include '../../path.php';
include SITE_ROOT . '/app/controls/posts.php';
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Admin posts edit page</title>
  <link rel="stylesheet" href="<?= BASE_URL . 'assets/css/post.css'; ?>">
</head>

<body>
  <div class="container">
    <main>
      <div class="row">
        <div class="form-place">
          <h4>Редактирование поста</h4>
          <div class="err">
            <!-- Вывод массива с ошибками -->
            <?php include SITE_ROOT . "/app/helps/error_info.php"; ?>
          </div>
          <hr>
          <form action="edit.php" method="post" enctype="multipart/form-data">
            <div>
              <input type="hidden" name="id" value="<?= $id; ?>">
              <div class="inp-box">
                <label for="title" class="form-label">Заголовок</label>
                <input value="<?= $post['title']; ?>" name="title" type="text" class="inp" id="title" placeholder="Заголовок поста" required>
              </div>
              <div class="inp-box">
                <label for="place" class="form-label">Место</label>
                <input  value="<?= $post['place']; ?>" name="place" type="text" class="inp" id="place" placeholder="Заведение" required>
              </div>
              <div class="inp-box">
                <label for="editor" class="form-label">Содержание</label>
                <textarea name="content" class="inp" id="editor"><?= $post['content']; ?></textarea>
              </div>
              <div class="inp-box">
                <label for="country" class="form-label">Категория</label>
                <select name="topic" class="form-select" id="country" required>
                  <?php foreach ($topics as $key => $topic) : ?>
                    <? if ($topic["id"] == $post['id_topic']) : ?>
                      <option selected value="<?= $topic['id']; ?>"><?= $topic['name'] ?></option>
                    <? else : ?>
                      <option value="<?= $topic['id']; ?>"><?= $topic['name'] ?></option>
                    <? endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="inp-box">
                <label for="file" class="form-label">Изображение</label>
                <input name="img" type="file" class="file-box" id="file">
              </div>
            </div>
            <hr>
            <div class="form-check">
              <?php if ($post['status'] == 0) : ?>
                <input name="publish" type="checkbox" class="checkbox" id="same-address">
              <?php else : ?>
                <input name="publish" type="checkbox" class="checkbox" id="same-address" checked>
              <?php endif; ?>
              <label class="form-check-label" for="same-address">Опубликовать / в черновик</label>
            </div>
            <hr>
            <ul class="c4">
              <li><button name="edit-post" type="submit">Редактировать пост</button></li>
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