<?php require_once PROJECT_ROOT . '/app/views/inc/get_post_user.php';?>

<?php
$post = $data["post"]["post"];
$comments = $data["post"]["comments"];
?>

<?php ob_start();?>

<div >

    <div class="mt1 mb1 ml1">
        <h2>    <?=$post['post_title']?>    </h2>
        <p class="mt1 mb1">
            <span class="colored-text2 ml05">  <?=get_name($post)?>  </span>
            à
            <span class="tiny-text colored-text3">  <?=$post['post_created_at']?>   </span>
        </p>
        <p class="bg-lll-grey mr1"> <?=nl2br($post['post_content'])?>  </p>
    </div>


    <?php foreach ($comments as $comment): ?>
        <div class="post-card">
            <p>
                <span class="colored-text2">  <?=get_name($comment)?>  </span>
                à
                <span class="tiny-text colored-text3">  <?=$comment['comment_created_at']?>   </span>
            </p>
            <hr class="mb1">
            <p> <?=nl2br($comment['comment_content'])?>    </p>
        </div>
    <?php endforeach;?>

    <form action="/apis/add_comment" method="post" class="ml1">
        <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
        <textarea name="comment_content" cols="60" rows="3" required></textarea>
        <button type="submit"  class="wp1"> Commenter   </button>
    </form>

</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>