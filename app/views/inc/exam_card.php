<?php
// ICON SELECTOR
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

    <?php if ($exam['result'] === "En attente"): ?>
    <?php if ($_SESSION['id'] === 0): ?>

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