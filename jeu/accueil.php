<!DOCTYPE html>
<html>
<head>
    <titre>Accueil bataille navale</titre>
</head>
<body>

<?php require_once('fonction.php') ?>

<form methode='POST' action='accueil.php'>
    <input id="pseudoL" name="pseudoLogin" type="text" placeholder="Pseudonyme">
    <input id="mdpL" name="mdpLogin" type="password" placeholder="Mot de passe">
    <input id="connectL" name="connect" type="submit" value="Se connecter">
    <input id="registerL" name="register" type="submit" value="S'enregistrer">
</form>
#<?php
#if (isset($_POST["connect"])) {
#    if ($_POST["pseudoLogin"] == mysqli_query($connexion, "SELECT pseudonyme FROM Joueur WHERE pseudonyme"
#    }
#if (isset($_POST["register"])) {
#
#}
#?>

<?php require_once('end.php') ?>
</body>
</html>