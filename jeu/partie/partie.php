<!DOCTYPE html>
<?php
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
include_once('../assets/class/Grid.php');
include_once('../assets/class/Match.php');
session_start();
?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Partie - Bataille navale</title>
    <!---- Pour tout le monde ---->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <!---- Ecran mobiles ---->
    <link href="../assets/css/mobile.css" rel="stylesheet" media="screen and (max-width: 768px)" type="text/css">
    <link href="../assets/css/mobile.css" rel="stylesheet" media="handheld" type="text/css">
    <!-- -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!-- Header -->
<header>
    <h1>Bataille navale</h1>
    <a href="#menu"><img src="../assets/images/menu-toogle.png" alt=""/></a>
</header>
<!-- Main -->
<main>
    <?php
    if (isset($_SESSION['partie'])) {
        echo 'Session !';
        require_once('currentMatch.php');
    } else if (isset($_POST['create'])) {
        echo 'Create !';
        $_SESSION['partie'] = new Match(-1);
        require_once('currentMatch.php');
    } else if (isset($_POST['join'])) {
        echo 'Join !';
        $_SESSION['partie'] = new Match($_POST['id_partie']);
        require_once('currentMatch.php');
    } else {
        echo 'Else !';
        require_once('matches.php');
    }
    ?>
</main>
<!-- Footer -->
<footer></footer>
<?php include_once('../assets/php/menu.php') ?>
</body>
</html>
<?php require_once('../assets/php/end.php') ?>