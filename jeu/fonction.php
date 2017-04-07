<?php

function login($id, $pwd)
{
    global $connexion;
    $result = mysqli_query($connexion, "SELECT * FROM Joueur WHERE pseudonyme = '$id' AND mdp = '$pwd' LIMIT 1");
    if ($result) {
        $array = $result->fetch_array();
    } else {
        print("Échec de la connexion :");
        return false;
    }

}

function register($id, $pwd) {
    global $connexion;
    if(!mysqli_query($connexion, "SELECT * FROM Joueur WHERE email = '$id'")) {
        mysqli_query($connexion, "INSERT INTO Joueur () VALUES ()")
    }
}


?>