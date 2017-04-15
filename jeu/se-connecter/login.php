<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <!---- Pour tout le monde ---->
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <!---- Ecran de PC ---->
    <link href="../css/normalscreen.css" rel="stylesheet" type="text/css">
    <!---- Ecran mobiles ---->
    <link href="../css/mobile.css" rel="stylesheet" media="screen and (max-width: 340px)" type="text/css">
    <link href="../css/mobile.css" rel="stylesheet" media="handheld" type="text/css">
    <!-- -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require_once('../init.php');
require_once('../fonction.php') ?>
<body>
<header>
    <h1>Bataille navale</h1>
    <a href="#menu"><img src="../images/menu-toogle.png" alt=""/></a>
</header>

<form method="POST" action="./login.php" style="margin-top: 50px">
    <input name="username" type="text" placeholder="Nom d'utilisateur">
    <input name="password" type="password" placeholder="Mot de passe">
    <input name="connect" type="submit" value="Se connecter">
</form>

<?php
    if(isset($_POST['connect'])) {
        echo login($_POST['username'], $_POST['password']);
    }
?>

<span style="color: black;"> <?php
    if(isset($_SESSION['username'])) {
        echo "Bonjour ".$_SESSION['username']." le fils de pute";
    } else {
        echo "Non connecté";
    } ?>
</span>

<!-- Footer -->
<footer></footer>

<!-- Menu -->
<nav id="menu">
    <a href="#">X</a>
    <ul>
        <li><a href="../">Accueil</a></li>
        <li><a href="../se-connecter">Se connecter</a></li>
        <li><a href="../s-inscrire">S'inscrire</a></li>
        <li><a href="../a-propos">A propos</a></li>
    </ul>
</nav>
</body>
</html>
<?php require_once('../end.php') ?>