<?php require_once PROJECT_ROOT . '/app/views/inc/cover.php';?>

<?php
$client = $data['client'];
$versements = $data['versements'];
$versements_sum = $data['versements_sum'];
?>

<?php ob_start();?>
<div class="p1">


<?php if(!empty($versements)): ?>
    <table>
        <tr>
            <th>    Montant (DA)    </th>
            <th>    Date et heure   </th>
        </tr>

    <?php foreach ($versements as $versement): ?>

        <tr>
            <td>    <?=$versement['amount']?>   </td>
            <td>    <?=$versement['versement_day']?>    </td>
        </tr>

    <?php endforeach ?>

    </table>
<?php endif ?>



<?php if($versements_sum >= 40000): ?>
    
    <h3>    Versement completé <i class="fas fa-check"></i> </h3>
    
<?php elseif($versements_sum < 40000): ?>

    <h4>    Il reste <?=40000 - $versements_sum?> DA à payer    </h4>

    <form action="/apis/add_versement" method="post" class="m1 p05 bg-lll-grey">
        <h3>    Nouveau versement   </h3>
        <p class="mb05">    Ajouter le nouveau versement fait par le client </p>
        <input type="hidden" name="client_id" value="<?=$client['client_id']?>">
        <input type="number" name="amount" min="0" max="<?=40000 - $versements_sum?>" required class="w9">
        <button type="submit">  Enregistrer le versement    </button>
    </form>

<?php endif; ?>



</div>
<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>