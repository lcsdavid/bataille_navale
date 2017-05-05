<!DOCTYPE html>
<?php
session_start();
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
?>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
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
    <h1>Statistiques - Bataille navale</h1>
    <a href="#menu"><img src="../assets/images/menu-toogle.png" alt=""/></a>
</header>
<!-- Main -->
<main>
    <table id="tstats">
        <tr>
            <th>Ennemi</th>
            <th>Creation</th>
            <th>Gagné</th>
            <th>Perdu</th>
        </tr>
        <?php

        global $connexion;
        $counterWin = 0;
        $counterLoose = 0;
        $rset = mysqli_query($connexion, "SELECT p.* FROM Partie p NATURAL JOIN Etat_partie e WHERE e.etat_partie LIKE 'finished' AND (id_joueur1 LIKE '".$_SESSION['ID']."' OR id_joueur2 LIKE '".$_SESSION['ID']."')");
            while ($row = $rset->fetch_row()) {
                if($_SESSION['ID'] == $row[1]) {
                    $ennemi = $row[2];
                } else {
                    $ennemi = $row[1];
                }
                if($_SESSION['ID'] == $row[3]){
                    $win = "X";
                    $loose = " ";
                    $counterWin++;
                } else {
                    $win = " ";
                    $loose = "X";
                    $counterLoose++;
                }
                echo "<tr>";
                echo    "<td>".$ennemi."</td>";
                echo    "<td>".$row[4]."</td>";
                echo    "<td>".$win."</td>";
                echo    "<td>".$loose."</td>";
                echo  "</tr>";
            }
                echo "<tr>";
                echo    "<th colspan='2'>Total</th>";
                echo    "<td>".$counterWin."</td>";
                echo    "<td>".$counterLoose."</td>";
                echo  "</tr>";
            ?>
        <table>
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