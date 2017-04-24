<?php

function login($id, $pwd)
{
    global $connexion;
    $result = mysqli_query($connexion, "SELECT pseudo FROM Joueur WHERE email = '" . $id . "' AND mdp = '" . md5($pwd) . "'");
    if ($result->num_rows == 1) {
        $_SESSION['username'] = $result->fetch_row()[0];
        $_SESSION['timestamp'] = time();
        return true;
    } else {
        return false;
    }
}

function register($email, $pseudo, $name, $firstname, $gender, $birth, $town, $pwd)
{
    global $connexion;
    if (mysqli_query($connexion, "SELECT * FROM Joueur WHERE email = '" . $email . "'")->num_rows == 0) {
        mysqli_query($connexion, "INSERT INTO Joueur (email, pseudo, nom, prenom, sexe, naissance, ville, mdp) VALUES ('" . $email . "','" . $pseudo . "','" . $name . "','" . $firstname . "','" . $gender . "','" . $birth . "','" . $town . "','" . md5($pwd) . "')");
        $_SESSION['username'] = $pseudo;
        $_SESSION['timestamp'] = time();
        return true;
    } else {
        return false;
    }
}

function redirect($url, $time = 5)
{
    header("Refresh:$time;Url=$url");
    echo "<div class='dialog'><main><header><h1>L'opération a bien été effectué !</h1></header>
    <p>Vous allez être redirigé dans quelques secondes sur la page d'accueil</p>
    <div class='one'>.</div><div class='two'>.</div><div class='three'>.</div></main></div>";
}
?>