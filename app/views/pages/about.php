<?php ob_start();?>

<div id="about">

    <div id="cover" class="mb1"></div>
    <div class="p1" id="flex1">

        <iframe width="560" height="315" src="https://www.youtube.com/embed/mXYSyxBlszE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

        <div id="text">
        <h2 class="about-text">Auto ecole</h2>
        Auto-ecole est la première auto-école agréée vous permettant d'organiser votre formation en ligne. Avec nous, vous bénéficiez d'une liberté et d'une flexibilité inégalées : vous pouvez réviser votre code de la route intégralement en ligne, réserver vos cours de conduite en quelques clics parmi l'un de nos 555 points de rendez-vous en France et gérer facilement la date de vos examens. Avec auto-ecole.net, vous pouvez simplement passer votre permis de conduire en moins de 3 mois et à prix réduit
        </div>

    </div>
</div>

<?php $content = ob_get_clean();?>
<?php require_once PROJECT_ROOT . '/app/views/inc/layout.php';?>
