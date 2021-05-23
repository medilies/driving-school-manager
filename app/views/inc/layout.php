<!DOCTYPE html>
<html lang="<?=$GLOBALS['LANG']?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- STYLESHEETS -->
    <link rel="stylesheet" href="/css/style.css">
    <?php if (isset($data['stylesheets_array'])): ?>
        <?php foreach ($data['stylesheets_array'] as $stylesheet_name): ?>
            <link rel="stylesheet" href="/css/<?=$stylesheet_name?>.css">
        <?php endforeach;?>
    <?php endif;?>
    <link rel="stylesheet" href="/css/fontawesome_free_5.13.0_we_all.min.css">

    <title><?=$GLOBALS['APP_NAME'] . ' | ' . $data['title']?></title>

</head>
<body>

<header>
    <nav>
        <div class="max-w flex-spaced p05">
            <div class="flex">
                <a href="/" class="mr1 ml1 colored-text3 flex-center">    <img src="/public/assets/img/logo.png" height="32px" alt="">    Auto école   </a>
            </div>
            <div class="flex">
                <a href="/" class="mr1 ml1"> Acceuil   </a>
                <a href="/pages/about" class="mr1 ml1">  Apropos </a>
                <a href="/pages/contact" class="mr1 ml1">  Contact </a>
                <a href="/pages/code" class="mr1 ml1">  Code </a>

            <?php if (!isset($_SESSION['id'])): ?>

                <a href="/pages/login" class="mr1 ml1"> Connecter   </a>
                <a href="/pages/join" class="mr1 ml1">  Rejoindre </a>
                <a href="/pages/admin" class="mr1 ml1">  Admin </a>
            </div>


            <?php elseif (isset($_SESSION['id'])): ?>

                <a href="/pages/forum" class="mr1 ml1"> <i class="fas fa-users"></i> Forum    </a>

            <?php if ($_SESSION['id'] === 0): ?>

                <a href="/pages/dash" class="mr1 ml1">  <i class="fas fa-calendar-day"></i> Examens    </a>
                <a href="/pages/clients_list" class="mr1 ml1">  <i class="fas fa-folder"></i> Dossiers    </a>

            <?php else: ?>

                <a href="/pages/agenda" class="mr1 ml1">    <i class="fas fa-user"></i> <?=$_SESSION['lname']?>    </a>

            <?php endif;?>

                <a href="/apis/logout" class="mr1 ml1">  <i class='fas fa-sign-out-alt'></i>   </a>
            </div>

            <?php endif;?>

        </div>
    </nav>
</header>

<main>
    <?=$content?>
</main>

<footer>
    copyright 2021
    <br>
    auto école
    <p class="tiny-text">
    HAI EL CHOUHADA, BOULEDVARD BENBOULAID N°19. MASCARA - SIG
    <br>
    0xxx 56 89 78 - contact@autoecole.com
    </p>
</footer>


<!-- SCRIPTS -->
<?php if (isset($data['scripts_array'])): ?>
    <?php foreach ($data['scripts_array'] as $script_name): ?>
        <script src="/js/<?=$script_name?>.js"></script>
    <?php endforeach;?>
<?php endif;?>

</body>
</html>