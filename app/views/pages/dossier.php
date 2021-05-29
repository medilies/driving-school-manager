<?php require_once PROJECT_ROOT . '/app/views/inc/cover.php';?>
<?php require_once PROJECT_ROOT . '/app/views/inc/dossier_element.php';?>

<?php
foreach ($data['client'] as $key => $value) {
    $$key = $value;
}
foreach ($data['dossier'] as $key => $value) {
    $$key = $value;
}
?>

<?php ob_start();?>

<?php if ($_SESSION['id'] === 0): ?>
    <?=cover("Validation du dossier du client")?>
<?php else: ?>
    <?=cover("Modification du dossier")?>
<?php endif; ?>

    <div class="mt1 p1">

        <h5 class="colored-text1"> <i class="fas fa-user-circle"></i>  Nom:   </h5>
        <p class="ml1"> <?=$lname?>   </p>

        <h5 class="colored-text1"> <i class="fas fa-user-circle"></i>  Prenom:   </h5>
        <p class="ml1"> <?=$fname?>   </p>

        <h5 class="colored-text1"> <i class="fas fa-birthday-cake"></i>    Date de naissance:   </h5>
        <p class="ml1"> <?=$bday?>    </p>

        <h5 class="colored-text1"> <i class="fas fa-envelope"></i> Email:   </h5>
        <p class="ml1"> <?=$mail?>    </p>

        <h5 class="colored-text1"> <i class="fas fa-mobile-alt"></i>   Telephone:   </h5>
        <p class="ml1"> <?=$phone?>   </p>

        <?=dossier_element("client_img", $mail, $client_id, "Photo personnelle", $client_img)?>

        <?=dossier_element("client_cni", $mail, $client_id, "Carte National d'identité", $client_cni)?>

        <?=dossier_element("client_health_cert", $mail, $client_id, "Certificat médicale", $client_health_cert)?>

        <?=dossier_element("client_blood", $mail, $client_id, "Carte de groupage", $client_blood)?>

        <?=dossier_element("client_residence", $mail, $client_id, "Certificat de résidence", $client_residence)?>

    </div>



<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>