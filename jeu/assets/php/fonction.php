<?php

function login($id, $pwd)
{
    global $connexion;
    $result = mysqli_query($connexion, "SELECT id_joueur FROM Joueur WHERE email = '" . $id . "' AND mdp = '" . md5($pwd) . "'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_row();
        $_SESSION['id'] = $row[0];
        $_SESSION['timestamp'] = time();
        mysqli_query($connexion, "INSERT INTO Etat_joueur (id_joueur, etat_joueur) VALUES ('" . $_SESSION['id'] . "','connected')");
        return true;
    } else {
        return false;
    }
}

function findTag()
{

}

function register($pseudo, $email, $name, $firstname, $gender, $birth, $town, $pwd)
{
    global $connexion;
    if (mysqli_query($connexion, "SELECT * FROM Joueur WHERE email LIKE '" . $email . "'")->num_rows == 0) {
        $rset = mysqli_query($connexion, "SELECT id_joueur FROM Joueur WHERE id_joueur = '" . $pseudo . "'");
        $tag = rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
        while ($row = $rset->fetch_row()) {
            $arr = explode("#", $row[0]);
            $other_tag = $arr[count($arr) - 1];
            if ($tag == $other_tag) {
                $tag = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
                $rset->data_seek(0);
            }
        }
        mysqli_query($connexion, "INSERT INTO Joueur (id_joueur, email, nom, prenom, sexe, naissance, ville, mdp) VALUES ('" . $pseudo . "#" . $tag . "','" . $email . "','" . $name . "','" . $firstname . "','" . $gender . "','" . $birth . "','" . $town . "','" . md5($pwd) . "')");
        $_SESSION['id'] = $pseudo . "#" . $tag;
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

/**
 * Crée une partie.
 */
function create()
{
    global $connexion;
    mysqli_query($connexion, "UPDATE Partie NATURAL JOIN Etat_partie SET etat_partie = 'cancelled' WHERE id_joueur1 = '" . $_SESSION['id'] . "' AND etat_partie = 'waiting'");
    mysqli_query($connexion, "INSERT INTO Partie (id_joueur1) VALUES ('" . $_SESSION['id'] . "')");
    $_SESSION['partie'] = new Partie(mysqli_query($connexion, "SELECT id_partie FROM Partie WHERE id_joueur1 = '" . $_SESSION['id'] . "' LIMIT 1"), $_SESSION['id'], null);
}

/**
 * Rejoint la partie avec l'id fourni en paramètre.
 * @param $id_partie
 */
function join($id_partie)
{
    global $connexion;
    mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '" . $_SESSION['id'] . "' WHERE id_partie = '" . $id_partie . "'");
    $_SESSION['partie'] = new Partie($id_partie, $_SESSION['id'], mysqli_query($connexion, "SELECT DISTINCT id_joueur1 FROM Partie WHERE id_partie = '" . $id_partie . "'"));
}

/**
 * Quitte la partie.
 * Nécessite qu'une partie existe et qu'elle soit contenu dans $_SESSION['partie'].
 */
function quit()
{
    global $connexion;
    mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '" . $_SESSION['id'] . "' WHERE id_partie = '" . $_SESSION['partie']->getIDPartie() . "'");
    mysqli_query($connexion, "UPDATE Etat_partie SET etat_partie = 'cancelled' WHERE id_partie = '" . $_SESSION['partie']->getIDPartie() . "'");
    unset($_SESSION['partie']);
    header("../");
}

?>