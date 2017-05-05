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
    <h1>Listing - Bataille navale</h1>
    <a href="#menu"><img src="../assets/images/menu-toogle.png" alt=""/></a>
</header>
<!-- Main -->
<main class="listing">
    <form method="POST" action="../partie/">
        <input name="create" type="submit" value="Créer Salohhhon">
    </form>
    <table>
        <tr>
            <th>Pseudo</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th> </th>
        </tr>
        <?php
        $rset = mysqli_query($connexion, "SELECT id_partie, id_joueur1, prenom, nom FROM Partie JOIN Joueur ON Partie.id_joueur1 = Joueur.id_joueur WHERE id_partie NOT IN (SELECT id_partie FROM Etat_partie)");
        while ($row = $rset->fetch_row()) {
            echo "<tr><form class='listing' method='POST' action='../partie/'><input type='hidden' name='id_partie' value='" . $row[0] . "'><td>" . $row[1] . "</td></td><td>"
                . $row[2] . "</td><td>" . $row[3] . "</td><td><input name='join' type='submit' value='Rejoindre'></td></form></tr>";
        }
        ?>
    </table>
</main>
<!-- Footer -->
<footer></footer>
<?php require_once('../assets/php/menu.php') ?>
</body>
</html>
<?php require_once('../assets/php/end.php') ?>