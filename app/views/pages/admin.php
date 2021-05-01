<?php ob_start();?>

<div class="center-xy mt5">
    <div class="form-card w-min">
        <p class="mb1 colored-text4"> Connecter pour gerer les éxamens de vos clients  </p>
        <div id="msg"></div>
        <form >

            <label for="username">  <i class="fas fa-fingerprint"></i> Identifiant </label>
            <input type="text" name="username" required>

            <label for="pass">  Mot de passe    </label>
            <input type="password" name="pass" autocomplete required>

            <button type="submit">  Connecter  </button>

        </form>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>