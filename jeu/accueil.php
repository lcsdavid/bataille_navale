<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Accueil - Bataille navale</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cross.css">
</head>
<body>

<?php require_once('init.php') ?>

<header id="header">
    <div id="header-logo">
        <a href="">Logo</a>
    </div>
    <h1>
        <span>Bataille navale</span>
    </h1>
    <nav>
        <ul>

        </ul>
    </nav>
</header>

<?php
$login = $pwd = "";
$loginErr = $pwdErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"])) {
        $loginErr = "L'identifiant est demandé.";
    } else {
        $name = $_POST["login"];
    }

    if (empty($_POST["pwd"])) {
        $pwdErr = "Le mot de passe est demandé.";
    } else {
        $pwd = md5($_POST["pwd"]);
    }
}
?>

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

    <p>
        fffffffffffffffff
        f
        f
        f

        f
        f
        f
        f
        f
        f
        f
        f
        f
        f
        f

        f
        f
        f
        f
        f
        f
        f
        f
        f

        f
        f
        f
        f
        f
        f

        ff

        f
        f
        f
        f
        f
        f
        f
        f

        f
        f
    </p>
</div>

<?php
#if (isset($_POST["connect"])) {
#    if ($_POST["pseudoLogin"] == mysqli_query($connexion, "SELECT pseudonyme FROM Joueur WHERE pseudonyme"
#    }
#if (isset($_POST["register"])) {
#
#}
#?>


<footer>

</footer>
<?php require_once('end.php') ?>
</body>
</html>