<!DOCTYPE html>
<html lang="fr">
<?php require_once('../init.php');
require_once('../fonction.php') ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Se connecter - Bataille navale</title>
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

<form method="POST" action="./login.php" style="margin-top: 50px">
    <input name="username" type="text" placeholder="Nom d'utilisateur">
    <input name="password" type="password" placeholder="Mot de passe">
    <input name="connect" type="submit" value="Se connecter">
</form>

<?php
    if(isset($_POST['connect'])) {
        echo login($_POST['username'], $_POST['password']);
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
<script>
    $.notify("En continuant votre navigation sur le site, vous acceptez l'usage des cookies", {"position": "bottom left"});
</script>

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