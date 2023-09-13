<!-- forms/login/logout.php Файл выхода с сайта -->

<?php

    session_start();

    include('../../path.php');

    session_unset();
    session_destroy();

    header('location: ' . BASE_URL);

?>
