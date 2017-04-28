<?php

function login($id, $pwd)
{
    global $connexion;
    $result = mysqli_query($connexion, "SELECT id_joueur, pseudo FROM Joueur WHERE email = '" . $id . "' AND mdp = '" . md5($pwd) . "'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_row();
        $_SESSION['id'] = $row[0];
        $_SESSION['username'] = $row[1];
        $_SESSION['timestamp'] = time();
        return true;
    } else {
        return false;
    }
}

function register($email, $pseudo, $name, $firstname, $gender, $birth, $town, $pwd)
{
    global $connexion;
    if (mysqli_query($connexion, "SELECT * FROM Joueur WHERE email LIKE '" . $email . "'")->num_rows == 0) {
        mysqli_query($connexion, "INSERT INTO Joueur (email, pseudo, nom, prenom, sexe, naissance, ville, mdp) VALUES ('" . $email . "','" . $pseudo . "','" . $name . "','" . $firstname . "','" . $gender . "','" . $birth . "','" . $town . "','" . md5($pwd) . "')");
        $_SESSION['id'] = mysqli_query($connexion, "SELECT DISTINCT id_joueur FROM Joueur WHERE email LIKE '" . $email . "'");
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

/*
function create()
{
    global $connexion;
    mysqli_query($connexion, "DELETE FROM Partie WHERE id_joueur1 = '".$_SESSION['id']."' AND etat LIKE \"attente\"");
    mysqli_query($connexion, "INSERT INTO Partie (id_joueur1, id_joueur2,  etat , vainqueur) VALUES ('".$_SESSION['id']."',null, 'attente', null)");
    }

function join($id_partie)
{
    global $connexion;
    mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '".$_SESSION['id']."', etat = 'en cours' WHERE id_partie = '".$id_partie."'");
}*/

function quitSalon($id_partie)
{
    global $connexion;
    mysqli_query($connexion, "DELETE FROM Partie WHERE id_partie = '".$id_partie."'");
    redirect("../",3);
}
?>