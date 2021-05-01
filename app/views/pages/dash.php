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

    <!--  -->
    <h4 class="colored-text1">  <i class='fas fa-book'></i>   Code:</h4>

    <?php foreach ($code as $exam): ?>
        <?php if ($client['client_id'] === $exam['client_id']): ?>


            <div class="card inline wp1 mt05 mb05 ml1">

                <p >    La date d'éxamen <span class="colored-text2">   <?=$exam['planned_on']?>   </span></p>
                <p class="ml1"> Etat: <span class="colored-text2">   <?=get_exam_icon($exam['result']) . ' ' . $exam['result']?>   </span></p>

                <?php if ($exam['result'] === "En attente"): ?>
                <form action="/apis/exam_result" method="post">
                        <input type="hidden" name="exam_id" value="<?=$exam['exam_id']?>">
                        <input type="hidden" name="exam_type" value="code">
                        <label for="result">  Résultat    </label>
                        <select name="result">
                            <option value="Réussit">    Réussit </option>
                            <option value="Raté">   Raté    </option>
                        </select>
                        <button type="submit">  Confirmer   </button>
                    </form>
                <?php endif?>

            </div>

        <?php endif;?>
    <?php endforeach;?>

    <?php if (!$client['code_pass']): ?>
        <form action="/apis/next_exam" method="post">
            <input type="hidden" name="client_id" value="<?=$client['client_id']?>">
            <input type="hidden" name="client_mail" value="<?=$client['mail']?>">
            <input type="hidden" name="exam_type" value="code">
            <label for="date" class="inline">   <i class='fas fa-calendar-alt'></i>  La date du prochain éxamen code  </label>
            <input type="date" name="date" class="inline w11" required>
            <button type="submit" class="inline w7">    Confirmer   </button>
        </form>
    <?php endif;?>
<!--  -->
    <h4 class="colored-text1">  <i class='fas fa-car-side'></i>  Créno:</h4>

    <?php foreach ($creno as $exam): ?>
        <?php if ($client['client_id'] === $exam['client_id']): ?>

            <div class="card inline wp1 mt05 mb05 ml1">
                <p >    La date d'éxamen <span class="colored-text2">   <?=$exam['planned_on']?>   </span></p>
                <p class="ml1"> Etat: <span class="colored-text2">  <?=get_exam_icon($exam['result']) . ' ' . $exam['result']?>   </span></p>

                <?php if ($exam['result'] === "En attente"): ?>
                <form action="/apis/exam_result" method="post">
                        <input type="hidden" name="exam_id" value="<?=$exam['exam_id']?>">
                        <input type="hidden" name="exam_type" value="creno">
                        <label for="result">  Résultat    </label>
                        <select name="result">
                            <option value="Réussit">    Réussit </option>
                            <option value="Raté">   Raté    </option>
                        </select>
                        <button type="submit">  Confirmer   </button>
                    </form>
                <?php endif?>

            </div>

        <?php endif;?>
    <?php endforeach;?>

    <?php if (!$client['creno_pass'] && $client['code_pass']): ?>
        <form  action="/apis/next_exam" method="post">
            <input type="hidden" name="client_id" value="<?=$client['client_id']?>">
            <input type="hidden" name="client_mail" value="<?=$client['mail']?>">
            <input type="hidden" name="exam_type" value="creno">
            <label for="date" class="inline">   <i class='fas fa-calendar-alt'></i>   La date du prochain éxamen créno  </label>
            <input type="date" name="date" class="inline w11" required>
            <button type="submit" class="inline w7">    Confirmer   </button>
        </form>
    <?php endif;?>
<!--  -->
    <h4 class="colored-text1">  <i class='fas fa-car-alt'></i>   Circuit:</h4>

    <?php foreach ($circuit as $exam): ?>
        <?php if ($client['client_id'] === $exam['client_id']): ?>

            <div class="card inline wp1 mt05 mb05 ml1">
                <p >    La date d'éxamen <span class="colored-text2">   <?=$exam['planned_on']?>   </span></p>
                <p class="ml1"> Etat: <span class="colored-text2">  <?=get_exam_icon($exam['result']) . ' ' . $exam['result']?>   </span></p>

                <?php if ($exam['result'] === "En attente"): ?>
                <form action="/apis/exam_result" method="post">
                        <input type="hidden" name="exam_id" value="<?=$exam['exam_id']?>">
                        <input type="hidden" name="exam_type" value="circuit">
                        <label for="result">  Résultat    </label>
                        <select name="result">
                            <option value="Réussit">    Réussit </option>
                            <option value="Raté">   Raté    </option>
                        </select>
                        <button type="submit">  Confirmer   </button>
                    </form>
                <?php endif?>

            </div>

        <?php endif;?>
    <?php endforeach;?>

    <?php if (!$client['circuit_pass'] && $client['creno_pass'] && $client['code_pass']): ?>
        <form action="/apis/next_exam" method="post">
            <input type="hidden" name="client_id" value="<?=$client['client_id']?>">
            <input type="hidden" name="client_mail" value="<?=$client['mail']?>">
            <input type="hidden" name="exam_type" value="circuit">
            <label for="date" class="inline">   <i class='fas fa-calendar-alt'></i>   La date du prochain éxamen circuit  </label>
            <input type="date" name="date" class="inline w11" required>
            <button type="submit" class="inline w7">    Confirmer   </button>
        </form>
    <?php endif;?>
    <hr>

<?php endforeach;?>

</div>
<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>