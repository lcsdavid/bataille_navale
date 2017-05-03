<!DOCTYPE html>
<?php
session_start();
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
require_once('../assets/php/class.php');
if (isset($_POST['create'])) {
    $_SESSION['partie'] = new Match();
}
if (isset($_POST['join'])) {
    $_SESSION['partie'] = new Match($_POST['id_partie']);
}
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
    <div id="me">
        <table id="my-grid" class="grid">
            <tr>
                <td class="cell empty"></td>
                <td class="cell coord">A</td>
                <td class="cell coord">B</td>
                <td class="cell coord">C</td>
                <td class="cell coord">D</td>
                <td class="cell coord">E</td>
                <td class="cell coord">F</td>
                <td class="cell coord">G</td>
                <td class="cell coord">H</td>
                <td class="cell coord">I</td>
                <td class="cell coord">J</td>
            </tr>
            <?php
            $_SESSION['partie']->getAllyGrid()->display() ?>
        </table>
    </div>
    <div id="center">

    </div>
    <div id="ennemy">
        <table id="ennemy-grid" class="grid">
            <tr>
                <td class="cell empty"></td>
                <td class="cell coord">A</td>
                <td class="cell coord">B</td>
                <td class="cell coord">C</td>
                <td class="cell coord">D</td>
                <td class="cell coord">E</td>
                <td class="cell coord">F</td>
                <td class="cell coord">G</td>
                <td class="cell coord">H</td>
                <td class="cell coord">I</td>
                <td class="cell coord">J</td>
            </tr>
            <?php
            $_SESSION['partie']->getEnnemyGrid()->display(); ?>
        </table>
    </div>
</main>
<!-- Footer -->
<footer></footer>
<!-- Menu -->
<nav id="menu">
    <a href="#">X</a>
    <ul>
        <li><a href="./">Accueil</a></li>
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