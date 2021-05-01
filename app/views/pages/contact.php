<?php ob_start();?>
<div id="wrap">

    <div id="contact">
        <form>
            <h5 class="mb1">Envoie nous un message</h5>
            <label>Email</label>
            <input type="email">
            <label>Nom complet</label>
            <input type="text">
            <label>Méssage</label>
            <textarea cols="30" rows="10"></textarea>
        </form>
        <div id="data">
            <p>Adresse: </p><p class="sp"> xxx</p><br>
            <p>Téléphone: </p><p class="sp"> 0xxxxx</p><br>
            <p>Email: </p><p class="sp"> x@x.x</p><br>
        </div>
    </div>
</div>

<footer>
    copyright 2021
    <br>
    auto école
</footer>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>
