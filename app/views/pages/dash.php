<?php require_once PROJECT_ROOT . '/app/views/inc/exam_card.php';?>
<?php require_once PROJECT_ROOT . '/app/views/inc/next_exam_form.php';?>

<?php ob_start();?>

<?php
foreach ($data['data'] as $key => $value) {
    $$key = $value;
}

for ($i = 0; $i < sizeof($clients); $i++) {

    $clients[$i]['code'] = [];
    $clients[$i]['code_pass'] = false;
    $clients[$i]['creno'] = [];
    $clients[$i]['creno_pass'] = false;
    $clients[$i]['circuit'] = [];
    $clients[$i]['circuit_pass'] = false;

    foreach ($code as $code_exam) {
        if ($code_exam['client_id'] === $clients[$i]['client_id']) {
            array_push($clients[$i]['code'], $code_exam);
            if ($code_exam['result'] === 'Réussit') {
                $clients[$i]['code_pass'] = true;
            }
        }
    }
    foreach ($creno as $creno_exam) {
        if ($creno_exam['client_id'] === $clients[$i]['client_id']) {
            array_push($clients[$i]['creno'], $creno_exam);
            if ($creno_exam['result'] === 'Réussit') {
                $clients[$i]['creno_pass'] = true;
            }
        }
    }
    foreach ($circuit as $circuit_exam) {
        if ($circuit_exam['client_id'] === $clients[$i]['client_id']) {
            array_push($clients[$i]['circuit'], $circuit_exam);
            if ($circuit_exam['result'] === 'Réussit') {
                $clients[$i]['circuit_pass'] = true;
            }
        }
    }

}
?>

<div class="p1">
<?php foreach ($clients as $client): ?>
    <h3 class="colored-text3">  <i class="fas fa-user-circle"></i> <?=$client['lname'] . ' ' . $client['fname']?></h3>
    <p> <i class="fas fa-birthday-cake"></i>    Né(e) le: <?=$client['bday']?></p>
    <p> <i class="fas fa-envelope"></i> <?=$client['mail']?></p>
    <p> <i class="fas fa-mobile-alt"></i> <?=$client['phone']?></p>

    <!-- <h4 class="colored-text1">  <i class='fas fa-book'></i>   Code:</h4> -->

    <?php foreach ($code as $exam): ?>
        <?php if ($client['client_id'] === $exam['client_id']): ?>
            <?php card($exam, 'code', 'code')?>
        <?php endif;?>
    <?php endforeach;?>

    <?php if (!$client['code_pass']): ?>
        <?php next_exam_form($client, 'code')?>
    <?php endif;?>

    <!-- <h4 class="colored-text1">  <i class='fas fa-car-side'></i>  Créno:</h4> -->

    <?php foreach ($creno as $exam): ?>
        <?php if ($client['client_id'] === $exam['client_id']): ?>
            <?php card($exam, 'creno', 'creno')?>
        <?php endif;?>
    <?php endforeach;?>

    <?php if (!$client['creno_pass'] && $client['code_pass']): ?>
        <?php next_exam_form($client, 'creno')?>
    <?php endif;?>

    <!-- <h4 class="colored-text1">  <i class='fas fa-car-alt'></i>   Circuit:</h4> -->

    <?php foreach ($circuit as $exam): ?>
        <?php if ($client['client_id'] === $exam['client_id']): ?>
            <?php card($exam, 'circuit', 'circuit')?>
        <?php endif;?>
    <?php endforeach;?>

    <?php if (!$client['circuit_pass'] && $client['creno_pass'] && $client['code_pass']): ?>
        <?php next_exam_form($client, 'circuit')?>
    <?php endif;?>
    <hr>

<?php endforeach;?>

</div>
<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>