<?php ob_start();?>

<?php
$posts = $data['posts'];
// echo "<pre>";
// var_dump($posts);
// echo "</pre>";
?>

<form action="/apis/add_post" method="post">

    <input type="text" name="post_title" placeholder="titre" required>
    <textarea name="post_content" cols="30" rows="3" required></textarea>
    <button type="submit">Publier</button>

</form>

<?php foreach ($posts as $post): ?>

    <div>
        <h3>    <?=$post['post_title']?>    </h3>
        <p>
            <span>  <?=$post['lname'] . ' ' . $post['fname']?>  </span>
            à
            <span class="tiny-text">  <?=$post['post_created_at']?>   </span>
        </p>
        <p><?=$post['post_content']?></p>
        <a href="/pages/post/<?=$post['post_id']?>">Voir plus</a>
    </div>

<?php endforeach;?>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>