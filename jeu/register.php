<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>S'enregitrer</title>
</head>
<body>

<?php require_once('init.php') ?>
<?php require_once('fonction.php') ?>


<header id="bn-masterhead-container-wrapper">
    <div id="bn-masterhead-container">
        <div id="bn-masterhead-logo-container">
            <span>proutprout</span>
        </div>
        <div id="bn-masterhead-user">
            <span>blablabla</span>
        </div>
        <div id="bn-masterhead-title">
            <span>Batille navale</span>
        </div>
    </div>
</header>



<form method="POST" action="accueil.php">
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

<?php require_once ('end.php') ?>
</body>
</html>