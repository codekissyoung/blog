<?php include_once "header.php" ?>

<ul>
<?php foreach( $file_tree as $file ): ?>
    <li>
        <img src="img/<?=$file?>" height="400">
        img/<?=$file?>
    </li>
<?php endforeach;?>
</ul>

<?php include_once "footer.php" ?>