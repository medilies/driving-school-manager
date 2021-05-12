<?php ob_start();?>

<?php
$posts = $data['posts'];
echo "<pre>";
var_dump($posts);
echo "</pre>";
?>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>