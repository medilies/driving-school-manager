<?php require_once PROJECT_ROOT . '/app/views/inc/get_file_path.php';?>

<?php
function dossier_element($element, $email, $client_id, $label, $validation)
{
    ?>

<?php ob_start();?>

<h5 class="colored-text4 mt1">    <?=$label?>   </h5>

<div class="element_dossier">
    <img src="<?=get_file_path($element, $email)?>">
</div>

<p class="mb05">

    <a href="<?=get_file_path($element, $email)?>" target="_blanc" class="colored-text4 u">    Voir<i class="fas fa-external-link-alt"></i></a>

    <?php if (!isset($validation)): ?>
        <span class="tiny-text">    (Element du dossier non verifié)    </span>
    <?php elseif ($validation === 0 ): ?>
        <span class="tiny-text">    (Element du dossier refusé) </span>
    <?php elseif ($validation === 1 ): ?>
        <span class="tiny-text">    (Element du dossier accepté)    </span>
    <?php endif;?>

</p>

<?php if ($validation !== 1 ): ?>

    <?php if ($_SESSION['id'] === 0): ?>

        <form action="/apis/validation_dossier" method="post" class="inline">

            <input type="hidden" name="validation_action" value="1">
            <input type="hidden" name="client_id" value="<?=$client_id?>">
            <input type="hidden" name="element" value="<?=$element?>">
            <button type="submit" class="wp1 inline">Valider</button>

        </form>

        <form action="/apis/validation_dossier" method="post" class="inline">

            <input type="hidden" name="validation_action" value="0">
            <input type="hidden" name="client_id" value="<?=$client_id?>">
            <input type="hidden" name="element" value="<?=$element?>">
            <button type="submit" class="wp1 inline">Refuser</button>

        </form>

    <?php else: ?>

        <form action="/apis/edit_dossier" method="post" enctype="multipart/form-data">
            <input type="hidden" name="file_name" value="<?=$element?>" required>
            <input type="file" name="<?=$element?>" accept=".png, .jpeg, .jpg, .pdf" required class="inline">
            <button type="submit" class="wp1 inline">Modifier <?=$label?></button>
        </form>

    <?php endif; ?>

<?php endif; ?>

<?php $dossier_element = ob_get_clean();?>

<?php
return $dossier_element;
}
?>