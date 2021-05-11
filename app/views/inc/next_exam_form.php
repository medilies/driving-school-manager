<?php
// CARD GENERATOR
function next_exam_form($client, $exam_type)
{
    ?>
<?php ob_start();?>
<form action="/apis/next_exam" method="post">
    <input type="hidden" name="client_id" value="<?=$client['client_id']?>">
    <input type="hidden" name="client_mail" value="<?=$client['mail']?>">
    <input type="hidden" name="exam_type" value="<?=$exam_type?>">
    <label for="date" class="inline">   <i class='fas fa-calendar-alt'></i>  La date du prochain éxamen <?=$exam_type?>  </label>
    <input type="date" name="date" class="inline w11" required>
    <button type="submit" class="inline w7">    Confirmer   </button>
</form>
<?php $form = ob_get_clean();?>

<?php
echo $form;
}
?>