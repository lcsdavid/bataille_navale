<!DOCTYPE html>
<html lang="fr">
<?php require_once('../init.php');
require_once('../fonction.php') ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>S'enregister - Bataille navale</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cross.css">
    <script src="../js/jquery.js"></script>
    <script src="../js/util.js"></script>
    <script src="../js/script.js"></script>
</head>
<body class="is-mobile is-menu-visible">
<!-- Header -->
<header id="header">
    <h1>Bataille navale</h1>
    <nav>
        <ul>
            <li>
                <a href="#menu" class="menuToggle" onclick="changeClass('is-mobile', 'is-mobile is-menu-visible')">
                    <span>Menu</span>
                </a>
            </li>
        </ul>
    </nav>
</header>

<form method="POST" action="../accueil.php">
    <input name="mail" type="text" placeholder="xxx@xxx.xxx">
    <input name="pseudo" type="text" placeholder="Gary lapute">
    <input name="pwd" type="password" placeholder="Mot de passe">
    <input name="nom" type="text" placeholder="Nom">
    <input name="prenom" type="text" placeholder="Prenom">
    <input name="sexe" type="radio" value="H"> Male
    <input name="sexe" type="radio" value="F"> Female
    <input name="naissance" type="text" placeholder="AAAA-MM-JJ">
    <input name="ville" type="text" placeholder="Ville">
    <input name="register" type="submit" value="S'enregistrer">
</form>

<?php
echo $connexion;
if(isset($_POST["register"])){
    $query = "INSERT INTO Joueur (email, pseudonyme, nom, prenom, sexe, naissance, ville, mdp) VALUES (" + $email + "," + $pseudo + "," + $name + "," + $firstname + "," + $gender + "," + $birth + "," + $town + "," + $pwd + ");";
mysqli_query($connexion, $query);
}
?>

<!-- Menu -->
<div id="menu">
    <ul>
        <li><a href="../" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Accueil</a></li>
        <li><a href="../se-connecter/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Se Connecter</a>
        </li>
        <li><a href="../inscription/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">S'inscrire</a></li>
        <li><a href="../contact/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">À Propos</a></li>
    </ul>
    <a href="#menu" class="close">
</div>
</body>
</html>
<?php require_once('../end.php') ?>