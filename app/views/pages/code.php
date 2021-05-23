<?php require_once PROJECT_ROOT . '/app/views/inc/code_book_page.php';?>

<?php
    $dir = PROJECT_ROOT . '/public/assets/code';
    $dir_details = scandir($dir);
    array_shift($dir_details);
    array_shift($dir_details);
?>

<?php ob_start();?>

    <div class="overlay hidden center-xy"></div>

    <div class="w800px center-x mt1 pt1">

    <?php foreach ($dir_details as $file_name): ?>

        <?= code_book_page($file_name)?>

    <?php endforeach;?>

    </div>

<?php $content = ob_get_clean();?>


<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>
