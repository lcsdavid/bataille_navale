<!DOCTYPE html>
<?php
session_start();
require_once('../assets/php/init.php');
require_once('../assets/php/fonction.php');
$register_accomplished = false;
if (isset($_POST["register"])) {
    if (register($_POST['mail'], $_POST['pseudo'], $_POST['nom'], $_POST['prenom'], $_POST['sexe'], $_POST['naissance'], $_POST['ville'], $_POST['pwd'])) {
        header('Location: ../');
        $register_accomplished = true;
    }
} ?>
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
<body>
<header>
    <h1>Bataille navale</h1>
    <a href="#menu"><img src="../assets/images/menu-toogle.png" alt=""/></a>
</header>
<!-- Main -->
<main>
    <!-- Formulaire -->
    <form class="register" method="POST" action="#">
        <span>Formulaire d'inscription</span>
        <table>
            <tr>
                <td>E-mail</td>
                <td><input name="mail" type="email" placeholder="xxx@xxx.xxx"></td>
                <td><?php echo "Test";
                    if (isset($_POST["register"]))
                        if (!isset($_POST["mail"]))
                            echo "L'email est requise !";
                        else if (!$register_accomplished)
                            echo "lol";
                    ?></td>
            </tr>
            <tr></tr>
            <tr>
                <td>Pseudo</td>
                <td><input name="pseudo" type="text" placeholder="Gary lapute"></td>
                <td></td>
            </tr>
            <tr></tr>
            <tr>
                <td>Mot de passe</td>
                <td><input name="pwd" type="password" placeholder="Mot de passe"></td>
                <td></td>
            </tr>
            <tr></tr>
            <tr>
                <td>Nom</td>
                <td><input name="nom" type="text" placeholder="Nom"></td>
                <td></td>
            </tr>
            <tr></tr>
            <tr>
                <td>Prénom</td>
                <td><input name="prenom" type="text" placeholder="Prenom"></td>
                <td></td>
            </tr>
            <tr></tr>
            <tr>
                <td>Sexe</td>
                <td>
                    <input name="gender" type="radio" value="H" title="Homme">Homme
                    <input name="gender" type="radio" value="F" title="Femme">Femme
                </td>
            </tr>
            <tr></tr>
            <tr>
                <td>Naissance</td>
                <td><input name="birth" type="date"
                           min="<?php echo date('Y-m-d', strtotime('-100 years')); ?>"
                           max="<?php echo date('Y-m-d', strtotime('-7 years')); ?>"
                           placeholder="AAAA-MM-JJ"></td>
                <td></td>
            </tr>
            <tr></tr>
            <tr>
                <td>Ville</td>
                <td><input name="ville" type="text" placeholder="Ville"></td>
                <td></td>
            </tr>
            <tr></tr>
        </table>
        <input name="register" type="submit" value="S'enregistrer">
    </form>
    <span>
            <?php if (isset($_SESSION['username'])) {
                echo "Bonjour " . $_SESSION['username'] . " le fils de pute";
            } else {
                echo "Non connecté";
            } ?>
        </span>
</main>
<!-- Footer -->
<footer></footer>
<!-- Menu -->
<nav id="menu">
    <a href="#">X</a>
    <ul>
        <li><a href="../">Accueil</a></li>
        <?php if (isset($_SESSION['username'])) {
            echo "<li><a href='../mon-compte'>Mon compte</a></li>";
            echo "<li><a href='../partie'>Partie</a></li>";
            echo "<li><a href='../statistique'>Statistique</a></li>";
            echo "<li><a href='../listing'>Listing</a></li>";
            echo "<li><a href='../assets/php/deconnexion.php'>Se déconnecter</a></li>";
        } else {
            echo "<li><a href='../se-connecter'>Se connecter</a></li>";
            echo "<li><a href='../s-inscrire'>S'inscrire</a></li>";
        } ?>
        <li><a href="../a-propos">A propos</a></li>
    </ul>
</nav>
</body>
</html>
<?php require_once('../assets/php/end.php') ?>