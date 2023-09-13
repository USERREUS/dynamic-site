<div class="sidebar">
    <div class="stick">
        <h2 class="hhr">
            Категории
        </h2>
        <ul>
            <?php foreach($topics as $key => $topic): ?>
                <li>
                    <a href="<?=BASE_URL . 'category.php?id=' . $topic['id'];?>"><?=$topic['name'];?></a>
                </li>
            <?php endforeach; ?>
            <li>
                <a href="<?=BASE_URL . 'index.php';?>">Все посты</a>
            </li>
        </ul>
        <hr>
    </div>
</div>