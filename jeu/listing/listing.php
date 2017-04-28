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
    <h1>Listing - Bataille navale</h1>
    <a href="#menu"><img src="../assets/images/menu-toogle.png" alt=""/></a>
</header>
<!-- Main -->
<main>
    <form method="POST" action="../partie/partie.php">
        <input name="create" type="submit" value="Créer Salohhhon">
    </form>
    <?php
    if(isset($_POST['valid_join'])){
        echo "<form method=POST action='../partie/partie/partie.php'>";
        echo "    <input type='hidden' name='join' value='ok'>";
        echo "    <input type='hidden' name='id_partie' value='" . $_POST['select_partie'] . "'>";
        echo "</form>";
    }
    ?>
    <form class="rejoindre_partie" method="POST" action="./listing.php">
        <table style="width:100%">
            <tr>
                <th>Pseudo</th>
                <th>Prenom</th>
                <th>Nom</th>
            </tr>
            <?php
                $rset = mysqli_query($connexion, 'SELECT DISTINCT j.id_joueur, j.pseudo, j.prenom, j.nom, p.id_partie FROM Joueur j ,Partie p WHERE p.etat = "attente" AND p.id_joueur1 = j.id_joueur');
                printf('Ligne: ');
                printf($rset->num_rows);
                while ($obj = mysqli_fetch_assoc($rset)) {
                    echo "<tr>\n";
                    echo "     <td><input type=\"radio\" name=\"select_partie\" value=".$obj['id_partie'].">".  $obj['pseudo'] ."<br></td>\n";
                    echo "     <td>".  $obj['prenom'] . "</td>\n";
                    echo "     <td>".  $obj['nom'] . "</td>\n";
                    echo "</tr>\n";
                }
                mysqli_free_result($rset);
            ?>
        </table>
        <input name="valid_join" type="submit" value="Valider Selection">
    </form>

</main>
<!-- Footer -->
<footer></footer>
<!-- Menu -->
<nav id="menu">
    <a href="#">X</a>
    <ul>
        <li><a href="./">Accueil</a></li>
        <?php
        if(isset($_SESSION['username'])) {
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