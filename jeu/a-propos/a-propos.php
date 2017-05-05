<?php
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <!---- Pour tout le monde ---->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <!---- Ecran mobiles ---->
    <link href="../assets/css/mobile.css" rel="stylesheet" media="screen and (max-width: 768px)" type="text/css">
    <link href="../assets/css/mobile.css" rel="stylesheet" media="handheld" type="text/css">
    <!-- Awesome Font -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- Header -->
<header>
    <h1>A Propos - Bataille navale</h1>
    <a href="#menu"><img src="../assets/images/menu-toogle.png" alt=""/></a>
</header>
<!-- Main -->
<main>
    <div class="nous">
         <h1>Bataille Navale</h1>
        <p>
            Ceci est notre projet de Bataille Navale réalisé avec l'université Lyon1.
        </p>
        <h2>
            Nous contacter ?
        </h2>
        <blockquote>
            Mr David Lucas
            p1506340
            <a href="mailto:david.lucas@etu.univ-lyon1.fr">david.lucas@etu.univ-lyon1.fr</a>
        </blockquote>
        <blockquote>
            Mr Sublet Gary
            p1506450
            <a href="mailto:gary.sublet@etu.univ-lyon1.fr">gary.sublet@etu.univ-lyon1.fr</a>
        </blockquote>
    </div>
</main>
<!-- Footer -->
<footer></footer>
<?php require_once('../assets/php/menu.php') ?>
</body>
</html>
<?php require_once('../assets/php/end.php') ?>