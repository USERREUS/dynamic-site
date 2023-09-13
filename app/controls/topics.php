<?php

    include SITE_ROOT . '/app/database/database.php';

    $err_msg = [];
    $id = '';
    $name = '';
    $descr = '';
    
    $topics = select_all('topics');

    // Код формы для формы создания категорий
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){
        $name    = trim($_POST['name']);
        $descr   = trim($_POST['description']);

        if($name == '' || $descr == ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }elseif(mb_strlen($name, 'UTF-8') < 2){
            array_push($err_msg, 'Название категории должно быть более 2-х символов.');
        }else{
            $existence = select_one('topics', ['name' => $name]);
            if($existence && !is_null($existence['name'])){
                array_push($err_msg, 'Категория с таким названием уже существует.');
            }else{
                $topic = [
                    'name'        => $name,
                    'description' => $descr,
                ];
                insert('topics', $topic);
                header('location: ' . BASE_URL . 'admin/topics/index.php');
            }
        }
    }else{
        $name = '';
        $descr = '';
    }

    // Редактирвоание категории
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $id = $_GET['id'];
        $topic = select_one('topics', ['id' => $id]);
        
        $id = $topic['id'];
        $name = $topic['name'];
        $descr = $topic['description'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){
        $name    = trim($_POST['name']);
        $descr   = trim($_POST['description']);

        if($name == '' || $descr == ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }elseif(mb_strlen($name, 'UTF-8') < 2){
            array_push($err_msg, 'Название категории должно быть более 2-х символов.');
        }else{
            $topic = [
                'name'        => $name,
                'description' => $descr,
            ];
            $id = $_POST['id'];
            $topic_id = update('topics', $id, $topic);
            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
    }

    // Удаление категории
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del-id'])){
        $id = $_GET['del-id'];
        delete('topics', $id);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    }
?>