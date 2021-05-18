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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52046.47367365852!2d0.11887246841504244!3d35.38282192659896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1281daa55e78cd19%3A0x70aae4403ad6f0ac!2sMascara!5e0!3m2!1sen!2sdz!4v1619906043143!5m2!1sen!2sdz" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>
