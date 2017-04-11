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

function register($connexion, $email, $pseudo, $name, $firstname, $gender, $birth, $town, $pwd)
{
    if (/*mysqli_query($connexion, "SELECT * FROM Joueur WHERE email = .$email.")->num_rows == 0*/ true) {
        $result = mysqli_query($connexion, "INSERT INTO Joueur (email, pseudonyme, nom, prenom, sexe, naissance, ville, mdp) VALUES (.$email.,.$pseudo.,.$name.,.$firstname,.$gender.,.$birth.,.$town.,.$pwd.)");
        login($email, $pwd);
    } else {
        // TODO "email déjà pris blablabla"
    }
    echo $result;
}

?>