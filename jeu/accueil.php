<!DOCTYPE html>
<html lang="fr">
<?php require_once('init.php')
    require_once('fonction.php') ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Accueil - Bataille navale</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cross.css">
</head>
<body>
<header id="header">
    <h1>Bataille navale</h1>
    <nav>
        <ul>
            <li>
                <a href="#menu" class="menuToggle">
                    <span>Menu</span>
                </a>
            </li>
        </ul>
    </nav>
</header>

<div class="content">
    <div id="connect-container-wrapper">
        <div id="connect-container">


        </div>
    </div>
    <form method="POST" action="accueil.php">
        <input name="login" type="text" placeholder="Identifiant">
        <input name="pwd" type="password" placeholder="Mot de passe">
        <input name="connect" type="submit" value="Se connecter">
    </form>
    <form method="POST" action="accueil.php">
        <input name="register" type="submit" value="S'enregistrer">
    </form>
</div>


<?php
require_once('init.php');

echo $connexion;
if (isset($_POST["register"])) {
    $query = "INSERT INTO Joueur (email, pseudonyme, nom, prenom, sexe, naissance, ville, mdp) VALUES (" . $email . "," . $pseudo . "," . $name . "," . $firstname . "," . $gender . "," . $birth . "," . $town . "," . $pwd . ")";
    mysqli_query($connexion, $query);
}
?>

<footer>

</footer>
<script>
    $.notify("En continuant votre navigation sur le site, vous acceptez l'usage des cookies", {"position": "bottom left"});
</script>
<div id="menu">
    <ul>
        <li><a href="http://redsky.fr/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Accueil</a></li>
        <li><a href="http://redsky.fr/skychat/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Sky Chat</a></li>
        <li><a href="http://redsky.fr/forums/1-blabla/page-1/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Forums</a>
        </li>
        <li><a href="http://redsky.fr/jvc-wiki-interactif/trombinoscope-jvc/"
               style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">FaceMash JVC</a></li>
        <li><a href="http://redsky.fr/compte/se-connecter/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">SeConnecter</a>
        </li>
        <li><a href="http://redsky.fr/compte/creer-un-compte/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">S'inscrire</a>
        </li>
        <li><a href="http://redsky.fr/contact/" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">À Propos</a></li>
    </ul>
    <a href="#menu" class="close" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></a><a href="#menu"
                                                                                                class="close"
                                                                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></a>
</div>
</body>
</html>
<?php require_once('end.php') ?>