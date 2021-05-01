<?php ob_start();?>

<?php
function get_exam_icon($result)
{
    switch ($result) {
        case 'En attente':
            return "<i class='fas fa-clock'></i>";
        case 'Réussit':
            return "<i class='fas fa-award'></i>";
        case 'Raté':
            return "<i class='fas fa-redo-alt'></i>";
    }
}
?>

<?php
foreach ($data['data'] as $key => $value) {
    $$key = $value;
}

?>

<div class="p1">
<!--  -->
<h4 class="colored-text1">  <i class='fas fa-book'></i>   Code:</h4>
<?php foreach ($code as $exam): ?>

    <div class="card inline wp1 mt05 mb05 ml1">
        <p >    La date d'éxamen <span class="colored-text2">   <?=$exam['planned_on']?>   </span></p>
        <p class="ml1"> Etat: <span class="colored-text2">  <?=get_exam_icon($exam['result']) . ' ' . $exam['result']?>   </span></p>
    </div>

<?php endforeach;?>

<!--  -->
<h4 class="colored-text1">  <i class='fas fa-car-side'></i>  Créno:</h4>
<?php foreach ($creno as $exam): ?>

    <div class="card inline wp1 mt05 mb05 ml1">
        <p >    La date d'éxamen <span class="colored-text2">   <?=$exam['planned_on']?>   </span></p>
        <p class="ml1"> Etat: <span class="colored-text2">  <?=get_exam_icon($exam['result']) . ' ' . $exam['result']?>   </span></p>
    </div>

<?php endforeach;?>

<!--  -->
<h4 class="colored-text1">  <i class='fas fa-car-alt'></i>   Circuit:</h4>
<?php foreach ($circuit as $exam): ?>

    <div class="card inline wp1 mt05 mb05 ml1">
        <p >    La date d'éxamen <span class="colored-text2">   <?=$exam['planned_on']?>   </span></p>
        <p class="ml1"> Etat: <span class="colored-text2">  <?=get_exam_icon($exam['result']) . ' ' . $exam['result']?>   </span></p>
    </div>

<?php endforeach;?>

</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>