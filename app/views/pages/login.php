<?php ob_start();?>

<div class="center-xy mt5">
    <div class="form-card">
        <p class="mb1 colored-text4"> Connéctez à votre compte de client  </p>
        <div id="msg"></div>
        <form >

            <label for="mail">  <i class="fas fa-envelope"></i>  Email   </label>
            <input type="email" name="mail" required>

            <label for="pass">  Mot de passe    </label>
            <input type="password" name="pass" autocomplete required>

            <button type="submit">  Se connecter  </button>

        </form>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>