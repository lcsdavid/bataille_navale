<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Accueil</title>
    <!---- Pour tout le monde ---->
    <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
    <!---- Ecran mobiles ---->
    <link href="../assets/css/mobile.css" rel="stylesheet" media="screen and (max-width: 340px)" type="text/css">
    <link href="../assets/css/mobile.css" rel="stylesheet" media="handheld" type="text/css">
    <!-- -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<?php
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php') ?>
<body>
<header>
    <h1>Bataille navale</h1>
    <a href="#menu"><img src="../assets/images/menu-toogle.png" alt=""/></a>
</header>

<form method="POST" action="./register.php" style="margin-top: 50px">
    <input name="mail" type="text" placeholder="xxx@xxx.xxx">
    <input name="pseudo" type="text" placeholder="Gary lapute">
    <input name="pwd" type="password" placeholder="Mot de passe">
    <input name="nom" type="text" placeholder="Nom">
    <input name="prenom" type="text" placeholder="Prenom">
    <input name="sexe" type="radio" value="H" title="Homme">
    <input name="sexe" type="radio" value="F" title="Femme">
    <input name="naissance" type="text" placeholder="AAAA-MM-JJ">
    <input name="ville" type="text" placeholder="Ville">
    <input name="register" type="submit" value="S'enregistrer">
</form>

<?php
if (isset($_POST["register"])) {
    register($_POST['mail'], $_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['naissance'], $_POST['ville'], $_POST['pwd']);
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
        <li><a href="../a-propos">A propos</a></li>
    </ul>
</nav>
</body>
</html>
<?php require_once('../assets/php/end.php') ?>