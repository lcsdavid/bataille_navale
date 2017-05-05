<?php
session_start();
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
if (isset($_POST['connect']))
    if (isset($_POST['username']) && isset($_POST['password']))
        if(login($_POST['username'], $_POST['password']))
            header('../../');
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
            <input name="username" type="text" placeholder="pseudo#0000 ou email">
            <?php
            if (isset($_POST['connect']))
                if (!isset($_POST['username']))
                    echo "<span>Veuillez rentrer un utilisateur.</span>"
            ?>
            <input name="password" type="password" placeholder="Mot de passe">
            <?php
            if (isset($_POST['connect']))
                if (!isset($_POST['username']))
                    echo "<span>Veuillez rentrer un mot de passe.</span>"
            ?>
            <input name="connect" type="submit" value="Se connecter">
        </form>
    </main>
    <!-- Footer -->
    <footer></footer>
    <!-- Menu -->
    <nav id="menu">
        <a href="#">X</a>
        <ul>
            <li><a href="../">Accueil</a></li>
            <?php
            if (isset($_SESSION['ID'])) {
                echo "<li><a href='../mon-compte'>Mon compte</a></li>";
                echo "<li><a href='../partie'>Partie</a></li>";
                echo "<li><a href='../statistique'>Statistique</a></li>";
                echo "<li><a href='../listing'>Listing</a></li>";
                echo "<li><a href='../assets/php/deconnexion.php'>Se déconnecter</a></li>";
            } else {
                echo "<li><a href='../se-connecter'>Se connecter</a></li>";
                echo "<li><a href='../s-inscrire'>S'inscrire</a></li>";
            }
            ?>
            <li><a href="../a-propos">à propos</a></li>
        </ul>
    </nav>
    </body>
    </html>
<?php require_once('../assets/php/end.php') ?>