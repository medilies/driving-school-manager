<?php ob_start();?>

<?php
$clients = $data['clients'];
// var_dump($data['clients'])
?>


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
        <th>Supprimer</th>
    </tr>
    <?php foreach ($clients as $client): ?>
    <tr>
        <td><?=$client['lname']?></td>
        <td><?=$client['fname']?></td>
        <td><?=$client['bday']?></td>
        <td><?=$client['mail']?></td>
        <td><?=$client['phone']?></td>
        <td><a href="/assets/uploads/<?=$client['mail']?>/client_img.png" target="_blanc" class="colored-text4">  Photo   </a></td>
        <td><a href="/assets/uploads/<?=$client['mail']?>/client_cni.png" target="_blanc" class="colored-text4">  CNI   </a></td>
        <td><a href="/assets/uploads/<?=$client['mail']?>/client_health_cert.png" target="_blanc" class="colored-text4">  Certificat médicale   </a></td>
        <td><a href="/assets/uploads/<?=$client['mail']?>/client_blood.png" target="_blanc" class="colored-text4">  Groupage   </a></td>
        <td><a href="/assets/uploads/<?=$client['mail']?>/client_img.png" target="_blanc" class="colored-text4">  Résidence   </a></td>
        <td><a href="/apis/delete_client/<?=$client['client_id']?>" class="colored-text1">  DEL   </a></td>
    </tr>
    <?php endforeach;?>
</table>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>