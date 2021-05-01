<?php ob_start();?>

<div class="center-xy mt5">
    <div class="form-card">
        <p class="mb1 colored-text4"> Créez votre compte de client  </p>
        <div id="msg"></div>
        <form >

            <label for="lname"> <i class="fas fa-user-circle"></i>  Nom </label>
            <input type="text" name="lname" required>

            <label for="fname"> <i class="fas fa-user-circle"></i>  Pénom   </label>
            <input type="text" name="fname" required>

            <label for="bday">  <i class="fas fa-birthday-cake"></i>    Date de naissance   </label>
            <input type="date" name="bday" required>

            <label for="phone"> <i class="fas fa-mobile-alt"></i>   Numéro de tel   </label>
            <input type="tel" name="phone" required>

            <label for="mail">  <i class="fas fa-envelope"></i>   Email   </label>
            <input type="email" name="mail" required>

            <label for="pass">  Mot de passe    </label>
            <input type="password" name="pass" autocomplete required>

            <button type="submit">  S'inscrire  </button>

        </form>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>