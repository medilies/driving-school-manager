<?php ob_start();?>

<div id="hero">
    <h1 >   L'auto école de vos reves   </h1>
    <p class="m1">  Inscivez vous pour passez les exament pour votre permis de conduite </p>
    <a href="/pages/join" class="btn">  Rejoins nous   </a>
</div>

<div id="offre">
    <h2>Nous offrons</h2>
    <div>
        <div class="card">
            <p><i class="fas fa-book-reader"></i></p>
            <p>Livre de code de la route</p>
        </div>
        <div class="card">
            <p><i class="fas fa-car"></i></p>
            <p>Cours de conduite</p>
        </div>
        <div class="card">
            <p><i class="fas fa-video"></i></p>
            <p>CD de vidéos des cours</p>
        </div>
        <div class="card">
            <p><i class="fas fa-calendar-day"></i></p>
            <p>Rendez vous d'éxamens</p>
        </div>
    </div>
</div>

<div id="clients">

    <div id="testamonial">
        <h2>Ce qu’en disent nos élèves...</h2>
        <div class="card">
            <p class="colored-text1"> <i class="fas fa-user"></i> Riad T. 4<i class="fas fa-star"></i> </p>
            <p>Très bon cours...</p>
        </div>
        <div class="card">
            <p class="colored-text1"> <i class="fas fa-user"></i> Fatma B. 4.5<i class="fas fa-star"></i> </p>
            <p>Les moniteurs sont adorables et a l'écoute le seul soucis est le fait qu'on m'annulemes heures de conduites a plusieurs reprises sachant que les prochaines dates de...</p>
        </div>
        <div class="card">
            <p class="colored-text1"> <i class="fas fa-user"></i> Amine M. 5<i class="fas fa-star"></i> </p>
            <p>Pasque je cet auto.ecole.confance...</p>
        </div>
    </div>

    <div id="stats">
        <div>
            30.000 <br> Condidat
        </div>
        <hr>
        <div>
            85% <br>  taux de réussite
        </div>
    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>
