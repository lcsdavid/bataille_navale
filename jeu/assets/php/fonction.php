<?php

/**
 * @param $id
 * @param $pwd
 * @return bool
 */
function login($id, $pwd)
{
    global $connexion;
    $result = mysqli_query($connexion, "SELECT id_joueur FROM Joueur WHERE email LIKE '" . $id . "' OR id_joueur = '". $id . "' AND mdp = '" . md5($pwd) . "'");
    if ($result->num_rows == 1) {
        $row = $result->fetch_row();
        $_SESSION['ID'] = $row[0];
        $_SESSION['timestamp'] = time();
        mysqli_query($connexion, "INSERT INTO Etat_joueur (id_joueur, etat_joueur) VALUES ('" . $_SESSION['ID'] . "','connected')");
        return true;
    }
    else return false;
}

/**
 * @param $pseudo
 * @param $email
 * @param $name
 * @param $firstname
 * @param $gender
 * @param $birth
 * @param $town
 * @param $pwd
 * @return bool
 */
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
        $_SESSION['ID'] = $pseudo . "#" . $tag;
        $_SESSION['timestamp'] = time();
        return true;
    } else return false;
}

/**
 * @param $url
 * @param int $time
 */
function redirect($url, $time = 5)
{
    header("Refresh:$time;Url=$url");
    echo "<div class='dialog'><main><header><h1>L'opération a bien été effectué !</h1></header>
    <p>Vous allez être redirigé dans quelques secondes sur la page d'accueil</p>
    <div class='one'>.</div><div class='two'>.</div><div class='three'>.</div></main></div>";
}

?>