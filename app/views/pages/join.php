<?php require_once PROJECT_ROOT . '/app/views/inc/cover.php';?>

<?php ob_start();?>

<?=cover("Créer un compte de condidat")?>

<div class="center-xy mt5 mb1">
    <div class="form-card">
        <p class="mb1 colored-text4"> Créez votre compte de client  </p>
        <div id="msg"></div>
        <form enctype="multipart/form-data">

            <div class="flex">
            <div>
                <label for="lname"> <i class="fas fa-user-circle"></i>  Nom </label>
                <input type="text" name="lname" pattern="([a-zA-Z]+\s?)*" required placeholder="Votre prenom">

                <label for="fname"> <i class="fas fa-user-circle"></i>  Pénom   </label>
                <input type="text" name="fname" pattern="([a-zA-Z]+\s?)*" required placeholder="Votre nom">

                <label for="bday">  <i class="fas fa-birthday-cake"></i>    Date de naissance   </label>
                <input type="date" name="bday" required>

                <label for="phone"> <i class="fas fa-mobile-alt"></i>   Numéro de tel   </label>
                <input type="tel" name="phone" pattern="[0-9]*" required>

                <label for="mail">  <i class="fas fa-envelope"></i>   Email   </label>
                <input type="email" name="mail" required>

                <label for="pass">  Mot de passe    </label>
                <input type="password" name="pass" autocomplete required>
            </div>

            <div class="ml1">
                <label for="client_cni">    Carte nationale d’identité  </label>
                <input type="file" name="client_cni" accept=".png, .jpeg, .jpg, .pdf" required>

                <label for="client_blood">  Carte de groupage    </label>
                <input type="file" name="client_blood" accept=".png, .jpeg, .jpg, .pdf" required>

                <label for="client_residence">  Certificat de résidence    </label>
                <input type="file" name="client_residence" accept=".png, .jpeg, .jpg, .pdf" required>

                <label for="client_health_cert">    Certificat médical  </label>
                <input type="file" name="client_health_cert" accept=".png, .jpeg, .jpg, .pdf" required>

                <label for="client_img">    Photo personnelle   </label>
                <input type="file" name="client_img" accept=".png, .jpeg, .jpg, .pdf" required>
            </div>
            </div>

            <button type="submit">  S'inscrire  </button>

        </form>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>