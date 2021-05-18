<?php require_once PROJECT_ROOT . '/app/views/inc/exam_card.php';?>
<?php require_once PROJECT_ROOT . '/app/views/inc/cover.php';?>

<?php ob_start();?>

<?=cover("Planning d'éxamens - Résultats d'éxamens")?>

<?php
foreach ($data['data'] as $key => $value) {
    $$key = $value;
}
?>

<div class="p1">
<!--  -->
<h4 class="colored-text1">  <i class='fas fa-book'></i>   Code:</h4>
<?php foreach ($code as $exam): ?>
    <?php card($exam, 'code', 'code')?>
<?php endforeach;?>

<!--  -->
<h4 class="colored-text1">  <i class='fas fa-car-side'></i>  Créno:</h4>
<?php foreach ($creno as $exam): ?>
    <?php card($exam, 'creno', 'creno')?>
<?php endforeach;?>

<!--  -->
<h4 class="colored-text1">  <i class='fas fa-car-alt'></i>   Circuit:</h4>
<?php foreach ($circuit as $exam): ?>
    <?php card($exam, 'circuit', 'circuit')?>
<?php endforeach;?>

</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>