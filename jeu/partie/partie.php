<!DOCTYPE html>
<?php
session_start();
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
require_once('../assets/php/class.php');
if (isset($_POST['create'])) {
    printf("hello");
    create();
    printf("bite");
    $_SESSION['my_grid'] = new Grid(1,1,1);
    $_SESSION['ennemy_grid'] = new Grid(1,1,1);
}
if (isset($_POST['join'])) {
    printf($_POST['id_partie']);
    join($_POST['id_partie']);
    $_SESSION['my_grid'] = new Grid(1,1,1);
    $_SESSION['ennemy_grid'] = new Grid(1,1,1);
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
                <td class="cell coord">1</td>
                <td class="cell coord">2</td>
                <td class="cell coord">3</td>
                <td class="cell coord">4</td>
                <td class="cell coord">5</td>
                <td class="cell coord">6</td>
                <td class="cell coord">7</td>
                <td class="cell coord">8</td>
                <td class="cell coord">9</td>
                <td class="cell coord">10</td>
            </tr>
            <?php
            $_SESSION['my_grid']->display(); ?>
        </table>
    </div>
    <div id="center">

    </div>
    <div id="ennemy">
        <table id="ennemy-grid" class="grid">
            <tr>
                <td class="cell empty"></td>
                <td class="cell coord">1</td>
                <td class="cell coord">2</td>
                <td class="cell coord">3</td>
                <td class="cell coord">4</td>
                <td class="cell coord">5</td>
                <td class="cell coord">6</td>
                <td class="cell coord">7</td>
                <td class="cell coord">8</td>
                <td class="cell coord">9</td>
                <td class="cell coord">10</td>
            </tr>
            <?php
            $_SESSION['ennemy_grid']->display(); ?>
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
        if (isset($_SESSION['username'])) {
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