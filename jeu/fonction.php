<?php

function login($id, $pwd)
{
    global $connexion;
    $result = mysqli_query($connexion, "SELECT username FROM Joueur WHERE email = '".$id."' AND mdp = '".md5($pwd)."'");
    if ($result->num_rows == 1) {
        session_start();
        $_SESSION['username'] = $result->fetch_field();
        $_SESSION['timestamp'] = time();
    } else {
        // Erreur
    }
}

function register($email, $pseudo, $name, $firstname, $gender, $birth, $town, $pwd)
{
    global $connexion;
    if (mysqli_query($connexion, "SELECT * FROM Joueur WHERE email = '".$email."'")->num_rows == 0);
    mysqli_query($connexion, "INSERT INTO Joueur (email, pseudonyme, nom, prenom, sexe, naissance, ville, mdp) VALUES ('".$email."','".$pseudo."','".$name."','".$firstname."','".$gender."','".$birth."','".$town."','".md5($pwd)."')");
}

?>