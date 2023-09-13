<header class="header-admin">
    <a class="h-a" href="#">Кабинет администратора: <?=$_SESSION['login'];?></a>
    <div class="navbar-admin">
        <ul class="c4">
            <a class="d-a" href="<?=BASE_URL . 'index.php';?>">На главную</a>
            <a class="d-a" href="<?=BASE_URL . 'forms/login/logout.php';?>">Выйти</a>
        </ul>
    </div>
</header>