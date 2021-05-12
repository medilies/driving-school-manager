<?php
function cover($text)
{
    ?>

<?php ob_start();?>

<div class="cover">
    <div>
        <h2><?=$text?></h2>
    </div>
</div>

<?php $card = ob_get_clean();?>

<?php
return $card;
}
?>