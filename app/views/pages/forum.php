<?php require_once PROJECT_ROOT . '/app/views/inc/get_post_user.php';?>

<?php ob_start();?>

<?php $posts = $data['posts'];?>

<div class="mt1 ml1">

    <form action="/apis/add_post" method="post">

        <input type="text" name="post_title" placeholder="titre" required>
        <textarea name="post_content" cols="60" rows="3" required></textarea>
        <button type="submit"  class="wp1">Publier</button>

    </form>

    <?php foreach ($posts as $post): ?>

        <div class="post-card">
            <h3>    <?=$post['post_title']?>    </h3>
            <p>
                <span class="colored-text2 ml05">  <?=get_name($post)?>  </span>
                à
                <span class="tiny-text colored-text3">  <?=$post['post_created_at']?>   </span>
            </p>
            <hr class="mb1">
            <p><?=$post['post_content']?></p>
            <a href="/pages/post/<?=$post['post_id']?>" class="tiny-text colored-text4 u">Commentaires</a>
        </div>

    <?php endforeach;?>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>