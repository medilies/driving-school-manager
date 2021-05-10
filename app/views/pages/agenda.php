<?php
// CARD GENERATOR
function card($exam, $exam_type, $card_cover_class)
{
    switch ($exam['result']) {
        case 'En attente':
            $border_result = "waitn";
            break;
        case 'Réussit':
            $border_result = "win";
            break;
        case 'Raté':
            $border_result = "loss";
            break;
    }
    ?>
<?php ob_start();?>
<div class="card2 inline mt05 mb05 ml1 <?=$border_result?>">

    <div class="<?=$card_cover_class?>"></div>

    <div>
    <p >    La date d'éxamen <span class="colored-text2">   <?=$exam['planned_on']?>   </span></p>
    <p class="ml1"> Etat: <span class="colored-text2">   <?=get_exam_icon($exam['result']) . ' ' . $exam['result']?>   </span></p>

    <?php if ($_SESSION['id'] === "admin"): ?>
    <?php if ($exam['result'] === "En attente"): ?>

        <form action="/apis/exam_result" method="post">
            <input type="hidden" name="exam_id" value="<?=$exam['exam_id']?>">
            <input type="hidden" name="exam_type" value="<?=$exam_type?>">
            <label for="result">  Résultat    </label>
            <select name="result">
                <option value="Réussit">    Réussit </option>
                <option value="Raté">   Raté    </option>
            </select>
            <button type="submit">  Confirmer   </button>
        </form>

    <?php endif?>
    <?php endif?>
    </div>

</div>
<?php $card = ob_get_clean();?>
<?php
echo $card;
}
?>

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

<?php ob_start();?>

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