<?php require_once PROJECT_ROOT . '/app/views/inc/cover.php';?>

<?php
function get_file_path($file_name, $client_email)
{
    $png = "/public/assets/uploads/$client_email/$file_name.png";
    $jpg = "/public/assets/uploads/$client_email/$file_name.jpg";
    $jpeg = "/public/assets/uploads/$client_email/$file_name.jpeg";
    $pdf = "/public/assets/uploads/$client_email/$file_name.pdf";

    if (file_exists(PROJECT_ROOT . $png)) {
        return $png;
    } else if (file_exists(PROJECT_ROOT . $jpg)) {
        return $jpg;
    } else if (file_exists(PROJECT_ROOT . $jpeg)) {
        return $jpeg;
    } else if (file_exists(PROJECT_ROOT . $pdf)) {
        return $pdf;
    }
}
?>

<?php
$clients = $data['clients'];
?>

<?php ob_start();?>

<?=cover("Gestion des dossiers des clients")?>

<table class="mt1 mr1 ml1">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de naissance</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Photo</th>
        <th>CNI</th>
        <th>Certificat médicale</th>
        <th>Groupage</th>
        <th>Résidence</th>
    </tr>
    <?php foreach ($clients as $client): ?>
    <tr>
        <td><?=$client['lname']?></td>
        <td><?=$client['fname']?></td>
        <td><?=$client['bday']?></td>
        <td><?=$client['mail']?></td>
        <td><?=$client['phone']?></td>
        <td><a href="<?=get_file_path("client_img", $client['mail'])?>" target="_blanc" class="colored-text4 u">  Photo   </a></td>
        <td><a href="<?=get_file_path("client_cni", $client['mail'])?>" target="_blanc" class="colored-text4 u">  CNI   </a></td>
        <td><a href="<?=get_file_path("client_health_cert", $client['mail'])?>" target="_blanc" class="colored-text4 u">  Certificat médicale   </a></td>
        <td><a href="<?=get_file_path("client_blood", $client['mail'])?>" target="_blanc" class="colored-text4 u">  Groupage   </a></td>
        <td><a href="<?=get_file_path("client_residence", $client['mail'])?>" target="_blanc" class="colored-text4 u">  Résidence   </a></td>
        <td><a href="/apis/delete_client/<?=$client['client_id']?>" class="colored-text1">  <i class="fas fa-trash-alt fa-2x"></i>   </a></td>
    </tr>
    <?php endforeach;?>
</table>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>