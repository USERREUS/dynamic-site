<!-- app/controls/users.php Файл обработки данных о пользователях -->

<?php
    
    include SITE_ROOT . '/app/database/database.php';

    $err_msg = [];
    $users = select_all('users');

// Код формы для регистрации
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
        $login    = trim($_POST['login']);
        $email    = trim($_POST['email']);
        $pass     = trim($_POST['pass']);
        $pass_rep = trim($_POST['pass_rep']);
        $admin    = 0;

        if($login === '' || $email === '' || $pass === '' || $pass_rep === ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }elseif(mb_strlen($login, 'UTF-8') < 2){
            array_push($err_msg, 'Логин должен быть более 2-х символов.');
        }elseif($pass !== $pass_rep){
            array_push($err_msg, 'Пароли в обоих полях должны совпадать!');
        }else{
            $existence = select_one('users', ['email' => $email]);
            if($existence && !is_null($existence['email'])){
                array_push($err_msg, 'Пользователь с такой почтой уже зарегистрирован.');
            }else{
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $post = [
                    'admin'     => $admin,
                    'user_name' => $login,
                    'email'     => $email,
                    'password'  => $pass
                ];
        
                $id = insert('users', $post);
                $user = select_one('users', ['id' => $id]);

                userAuth($user);
            }
        }
    }else{
        $login    = '';
        $email    = '';
        $admin    = 0;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
        $email    = trim($_POST['email']);
        $pass     = trim($_POST['pass']);

        if($email === '' || $pass === ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }else{     
            $existence = select_one('users', ['email' => $email]);
            if($existence && password_verify($pass, $existence['password'])){
                // Авторизация
                userAuth($existence);
                if(isset($_POST['save'])){
                    setcookie('email', $email);
                    setcookie('pass', $pass);
                    setcookie('save', 1);
                }
                else{
                    setcookie('email', $email, time() - 3600);
                    setcookie('pass', $pass, time() - 3600);
                    setcookie('save', 0, time() - 3600);
                }
            }else{
                // Ошибка авторизации
                array_push($err_msg, 'Почта либо пароль введены неверно.');
            }
        }
    }

    function userAuth($data_arr){
        $_SESSION['id'] = $data_arr['id'];
        $_SESSION['login'] = $data_arr['user_name'];
        $_SESSION['admin'] = $data_arr['admin'];
        if($_SESSION['admin']){
            header('location: ' . BASE_URL . 'admin/index.php');
        }else{
            header('location: ' . BASE_URL . 'user/index.php');
        }
    }

    // Код добавления пользователя в админке
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){
        $login    = trim($_POST['login']);
        $email    = trim($_POST['email']);
        $pass     = trim($_POST['pass']);
        $pass_rep = trim($_POST['pass_rep']);
        $admin    = 0;

        if($login === '' || $email === '' || $pass === '' || $pass_rep === ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }elseif(mb_strlen($login, 'UTF-8') < 2){
            array_push($err_msg, 'Логин должен быть более 2-х символов.');
        }elseif($pass !== $pass_rep){
            array_push($err_msg, 'Пароли в обоих полях должны совпадать!');
        }else{
            $existence = select_one('users', ['email' => $email]);
            if($existence && !is_null($existence['email'])){
                array_push($err_msg, 'Пользователь с такой почтой уже зарегестрирован.');
            }else{
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                
                if(isset($_POST['admin'])){
                    $admin = 1;
                }

                $user = [
                    'admin'     => $admin,
                    'user_name' => $login,
                    'email'     => $email,
                    'password'  => $pass
                ];
                insert('users', $user);
                header('location: ' . BASE_URL . 'admin/users/index.php');
            }
        }
    }else{
        $login = '';
        $email = '';
        $admin    = 0;
    } 

    // Удаление пользователя
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del-id'])){
        $id = $_GET['del-id'];
        delete('users', $id);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }

    // Редактирвоание пользователя через админку
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit-id'])){
        $user = select_one('users', ['id' => $_GET['edit-id']]);
        $id = $user['id'];
        $admin = $user['admin'];
        $login = $user['user_name'];
        $email = $user['email'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user'])){
        $id = $_POST['id'];
        $email   = trim($_POST['email']);
        $login = trim($_POST['login']);
        $pass  = trim($_POST['pass']);
        $pass_rep   = trim($_POST['pass_rep']);
        $admin = isset($_POST['admin']) ? 1 : 0;

        if($login === ''){
            array_push($err_msg, 'Не все поля заполнены!');
        }elseif(mb_strlen($login, 'UTF-8') < 2){
            array_push($err_msg, 'Логин должен быть более 2-х символов.');
        }elseif($pass !== $pass_rep){
            array_push($err_msg, 'Пароли в обоих полях должны совпадать!');
        }else{
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $user = [
                'admin'     => $admin,
                'user_name' => $login,
                'password'  => $pass
            ];

            $user = update('users', $id, $user);
            header('location: ' . BASE_URL . 'admin/users/index.php');
        }
    }else{
        if(isset($user)){
            $login = $user['user_name'];
            $email = $user['email'];
        }
    }

?>