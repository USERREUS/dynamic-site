<header class="header-main">
    <div class="b1">
        <div class="b2">
            <a href="<?=BASE_URL . 'index.php';?>" class="c3">
                Eat a lot, eat well
            </a>

            <ul class="c4">
                <li><a href="<?= BASE_URL . 'index.php'; ?>" class="c5">На главную</a></li>
                <? if (isset($_SESSION['login'])) : ?>
                    <li><a href="<?= BASE_URL . ($_SESSION['admin'] == 1 ? 'admin/' : 'user/') . 'index.php'; ?>" class="c5"><?= $_SESSION['login']; ?></a></li>
                <? endif; ?>
            </ul>

            <form class="f" action="search.php" method="post">
                <input name="search-term" class="i" type="search" placeholder="Поиск..." aria-label="Поиск">
            </form>

            <div class="t">
                <?php if (isset($_SESSION['id'])) : ?>
                    <?php if ($_SESSION['admin'] == 1) : ?>
                        <a class="btn" href="<?= BASE_URL . 'admin/index.php'; ?>"><i class="fa-solid fa-user-shield"></i> Управление</a>
                    <?php else : ?>
                        <a class="btn" href="<?= BASE_URL . 'user/index.php'; ?>"><i class="fa-solid fa-user-large"></i> Личный кабинет</a>
                    <?php endif; ?>
                    <a class="btn_2" href="<?= BASE_URL . 'forms/login/logout.php'; ?>">Выход</a>
                <?php else : ?>
                    <a class="btn" href="<?= BASE_URL . 'forms/login/login.php'; ?>">Регистрация</a>
                    <a class="btn_2" href="<?= BASE_URL . 'forms/signin/signin.php'; ?>">Войти</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>