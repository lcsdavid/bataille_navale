<!DOCTYPE html>
<?php
session_start();
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
require_once ('../assets/php/class.php');
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

    if (isset($_POST['create'])) {
        echo 'Test';
        /*$_SESSION['partie'] = new Match(-1);*/
        /* Moi */
        echo '<div id="me"><table id="my-grid" class="grid"><tr><td class="cell empty"></td>';
        for ($i = 'A'; $i < 'K'; $i++) {
            echo '<td class="cell coord">' . $i . '</td>';
        }
        echo '</tr>';
        /* $_SESSION['partie']->getAllyGrid()->display(); */
        echo '</table></div>';

        /* Cartes */
        echo '<div id="cards"></div>';
        /* Ennemi */
        echo '<div id="ennemy"><table id="ennemy-grid" class="grid"><tr><td class="cell empty"></td>';
        for ($i = 'A'; $i < 'K'; $i++) {
            echo '<td class="cell coord">' . $i . '</td>';
        }
        echo '</tr>';
        /* $_SESSION['partie']->getEnnemyGrid()->display(); */
        echo '</table></div>';
    } else if (isset($_POST['join'])) {
        /* $_SESSION['partie'] = new Match($_POST['id_partie']); */
        /* Moi */
        echo '<div id="me"><table id="my-grid" class="grid"><tr><td class="cell empty"></td>';
        for ($i = 'A'; $i < 'K'; $i++) {
            echo '<td class="cell coord">' . $i . '</td>';
        }
        echo '</tr>';
        /* $_SESSION['partie']->getAllyGrid()->display(); */
        echo '</table></div>';

        /* Cartes */
        echo '<div id="cards"></div>';
        /* Ennemi */
        echo '<div id="ennemy"><table id="ennemy-grid" class="grid"><tr><td class="cell empty"></td>';
        for ($i = 'A'; $i < 'K'; $i++) {
            echo '<td class="cell coord">' . $i . '</td>';
        }
        echo '</tr>';
        /* $_SESSION['partie']->getEnnemyGrid()->display();*/
        echo '</table></div>';
    } else
        require_once('matches.php');
    ?>
</main>
<!-- Footer -->
<footer></footer>
<?php include_once('../assets/php/menu.php') ?>
</body>
</html>
<?php require_once('../assets/php/end.php') ?>