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

function salon()
{
    global $connexion;
    printf("lucas <3");
    $id = $_SESSION['username'];
    $rset = mysqli_query($connexion, "SELECT id_joueur FROM Joueur WHERE pseudo = '".$id."'");
    $id_joueur = $rset->fetch_row()[0];
    mysqli_query($connexion, "DELETE FROM Partie WHERE id_joueur1 = '".$id_joueur."' AND etat LIKE \"attente\"");
    if(mysqli_query($connexion, "INSERT INTO Partie (id_joueur1, id_joueur2,  etat , vainqueur) VALUES ('".$id_joueur."',null, 'attente', null)") === TRUE)
    {
        $rset = mysqli_query($connexion, "SELECT id_partie from Partie where id_joueur1='".$id_joueur."' and etat like \"attente\"");
        header("Refresh:0;Url=\"../partie/partie.php?id_partie=".$rset->fetch_row()[0]);
    }
    else
    {
        return false;
    }
}

function joinSalon($host)
{
    printf("rpz les quartiers");
    global $connexion;
    $id = $_SESSION['username'];
    $rset = mysqli_query($connexion, "SELECT id_joueur FROM Joueur WHERE pseudo = '".$id."'");
    $id_joueur = $rset->fetch_row()[0];
    printf("id_joueur : ");
    printf($id_joueur);
    $rset = mysqli_query($connexion, "SELECT DISTINCT p.id_partie FROM Partie p, Joueur j WHERE p.id_joueur1 = '".$host."' AND p.etat LIKE 'attente'");
    $id_partie = $rset->fetch_row()[0];
    printf("id_partie : ");
    printf($id_partie);
    if(mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '".$id_joueur."', etat = 'en cours' WHERE id_partie = '".$id_partie."'") === TRUE)
    {
        header("Refresh:0;Url=\"../partie/partie.php?id_partie=".$id_partie);
    } else {
        printf("Erreur lors du rejoignement de la partie");
    }
}

function adversaire()
{

}
?>