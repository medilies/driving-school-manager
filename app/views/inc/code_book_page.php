<?php
function code_book_page($file_name)
{
    ?>

<?php ob_start();?>

<img src="/public/assets/code/<?=$file_name?>" alt="Page du livre de code" class="m05 pointer" code_book_page>

<?php $card = ob_get_clean();?>

<?php
return $card;
}
?>