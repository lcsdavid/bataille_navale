<?php
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
session_start();
if (isset($_POST['connect'])) {
    login($_POST['username'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Se connecter - Bataille navale</title>
    <!---- Pour tout le monde ---->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <!---- Ecran mobiles ---->
    <link href="../assets/css/mobile.css" rel="stylesheet" media="screen and (max-width: 340px)" type="text/css">
    <link href="../assets/css/mobile.css" rel="stylesheet" media="handheld" type="text/css">
    <!-- Awesome Font -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
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
    <form method="POST" action="./" style="margin-top: 50px">
        <input name="username" type="text" placeholder="Nom d'utilisateur">
        <input name="password" type="password" placeholder="Mot de passe">
        <input name="connect" type="submit" value="Se connecter">
    </form>
</main>
<!-- Footer -->
<footer></footer>
<?php require_once('../assets/php/menu.php') ?>
</body>
</html>
<?php require_once('../assets/php/end.php') ?>