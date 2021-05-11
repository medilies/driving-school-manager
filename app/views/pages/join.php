<?php ob_start();?>

<div class="center-xy mt5">
    <div class="form-card">
        <p class="mb1 colored-text4"> Créez votre compte de client  </p>
        <div id="msg"></div>
        <form enctype="multipart/form-data">

            <div class="flex">
            <div>
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
            </div>

            <div class="ml1">
                <label for="client_cni">CNI</label>
                <input type="file" name="client_cni" accept="image/png" required>

                <label for="client_blood">Groupage</label>
                <input type="file" name="client_blood" accept="image/png" required>

                <label for="client_residence">Réidence</label>
                <input type="file" name="client_residence" accept="image/png" required>

                <label for="client_health_cert">Certificat médical</label>
                <input type="file" name="client_health_cert" accept="image/png" required>

                <label for="client_img">Photo</label>
                <input type="file" name="client_img" accept="image/png" required>
            </div>
            </div>

            <button type="submit">  S'inscrire  </button>

        </form>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>