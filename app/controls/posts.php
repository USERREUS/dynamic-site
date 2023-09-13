<?php

    include SITE_ROOT . '/app/database/database.php';

    $err_msg = [];
    
    $topics = select_all('topics');
    $posts = select_all('posts');
    $postsAdm = select_all_from_posts_with_users('posts', 'users');

    // Код формы для формы создания записи
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-post'])){
        // Подгрузка изображения (ошибка работает неправильно - все равно выполняется)
        if(!empty($_FILES['img']['name'])){
            $img_name = time() . "_" . $_FILES['img']['name'];
            $file_tmp_name = $_FILES['img']['tmp_name'];
            $file_type = $_FILES['img']['type'];
            $destination = ROOT_PATH . "\assets\images\\" . $img_name;

            // Проверка
            if(strpos($file_type, 'image') === false){
                array_push($err_msg, 'Загружаемый файл не является изображением.');
            }else{
                $result = move_uploaded_file($file_tmp_name, $destination);
                if($result){
                    $_POST['img'] = $img_name;
                }else{
                    array_push($err_msg, 'Ошибка загрузки изображения на сервер.');
                }
            }
        }else{
            array_push($err_msg, 'Ошибка получения картинки.');
        }

        $title   = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic   = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0;
        $place   = isset($_POST['place']);

        if($title == '' || $content == '' || $topic == '' || $place == ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }elseif(mb_strlen($title, 'UTF-8') < 5){
            array_push($err_msg, 'Название поста должно быть более 4 символов.');
        }else{
            $post = [
                'user_id' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],
                'status' => $publish,
                'id_topic' => $topic,
                'place' => $place
            ];

            insert('posts', $post);
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    }else{
        $id = '';
        $title = '';
        $content = '';
        $publish = isset($_POST['publish']) ? 1 : 0;
        $topic = '';
        $place = '';
    }

// Редактирвоание статьи
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $post = select_one('posts', ['id' => $_GET['id']]);
        $id = $post['id'];
        $title = $post['title'];
        $content = $post['content'];
        $topic = $post['id_topic'];
        $publish = $post['status'];
        $place = $post['place'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-post'])){
        // Подгрузка изображения (ошибка работает неправильно - все равно выполняется)
        if(!empty($_FILES['img']['name'])){
            $img_name = time() . "_" . $_FILES['img']['name'];
            $file_tmp_name = $_FILES['img']['tmp_name'];
            $file_type = $_FILES['img']['type'];
            $destination = ROOT_PATH . "\assets\images\\" . $img_name;

            // Проверка
            if(strpos($file_type, 'image') === false){
                array_push($err_msg, 'Загружаемый файл не является изображением.');
            }else{
                $result = move_uploaded_file($file_tmp_name, $destination);
                if($result){
                    $_POST['img'] = $img_name;
                }else{
                    array_push($err_msg, 'Ошибка загрузки изображения на сервер.');
                }
            }
        }else{
            array_push($err_msg, 'Ошибка получения картинки.');
        }

        $id = $_POST['id'];
        $title   = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic   = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0;
        $place = isset($_POST['place']);

        if($title == '' || $content == '' || $topic == '' || $place == ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }elseif(mb_strlen($title, 'UTF-8') < 5){
            array_push($err_msg, 'Название поста должно быть более 4 символов.');
        }else{
            $post = [
                'user_id' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],
                'status' => $publish,
                'id_topic' => $topic,
                'place' => $place
            ];

            $post = update('posts', $id, $post);
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    }else{
        $title = '';
        $content = '';
        $publish = isset($_POST['publish']) ? 1 : 0;
        $topic = '';
        $place = '';
    }

    // Удаление статьи
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del-id'])){
        $id = $_GET['del-id'];
        delete('posts', $id);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }

    // Изменение статуса статьи
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub-id'])){
        $id = $_GET['pub-id'];
        $publish = $_GET['pub'];

        $post_id = update('posts', $id, ['status' => $publish]);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
        exit();
    }
?>