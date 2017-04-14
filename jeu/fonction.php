<?php

function login($id, $pwd)
{
    global $connexion;
    $result = mysqli_query($connexion, "SELECT * FROM Joueur WHERE email = .$id. AND mdp = MD5(.$pwd.)");
    if ($result) {
        $array = $result->fetch_array();
    } else {
        return false;
    }
}

function register($email, $pseudo, $name, $firstname, $gender, $birth, $town, $pwd)
{
    global $connexion;
    mysqli_query($connexion, "INSERT INTO Joueur (email, pseudonyme, nom, prenom, sexe, naissance, ville, mdp) VALUES ('".$email."','".$pseudo."','".$name."','".$firstname."','".$gender."','".$birth."','".$town."','".$pwd."')");
}

?>