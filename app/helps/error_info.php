<?php if(count($err_msg) > 0): ?>
    <ul>
        <?php foreach($err_msg as $error): ?>
            <li><?=$error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>