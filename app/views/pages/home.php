<?php ob_start();?>

<div id="hero">
    <h1 >L'auto école de vos reves</h1>
    <p class="m1">Inscivez vous pour passez les exament pour votre permis de conduite</p>
    <a href="/pages/join" class="btn">Rejoin nous</a>
</div>

<div id="offre">
    <h2>Nous offrons</h2>
    <div>
        <div class="card">Livre de code de la route</div>
        <div class="card">Cours de conduite</div>
        <div class="card">Rendez vous d'éxamens</div>
    </div>
</div>

<div id="clients">

    <div id="testamonial">
        <h2>Ce qu’en disent nos élèves...</h2>
        <div class="card">
            <p>Riad T.</p>
            <p>Très bon cours...</p>
        </div>
        <div class="card">
            <p>Fatma B.</p>
            <p>Les moniteurs sont adorables et a l'écoute le seul soucis est le fait qu'on m'annulemes heures de conduites a plusieurs reprises sachant que les prochaines dates de...</p>
        </div>
        <div class="card">
            <p>Amine M.</p>
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

    <footer>
        copyright 2021
        <br>
        auto école
    </footer>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>
