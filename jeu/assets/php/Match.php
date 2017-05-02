<?php

class Match
{
    private $id_partie;
    private $ally_grid;
    private $ennemy_grid;

    function __construct($id_partie, $my_id, $opponent_id)
    {
        $this->id_partie = $id_partie;
        $this->ally_grid = new Grid($id_partie, $my_id, ALLY);
        if ($opponent_id != null)
            $this->ennemy_grid = new Grid($id_partie, $opponent_id, ENNEMY);
    }

    public function fire()
    {
        global $connexion;
        return false;
    }

    /**
     * Pose un bateau.
     * @param $position string
     * @param $type_vessel string
     * @param $orientation string
     * @return bool
     */
    public function layVessel($position, $type_vessel, $orientation)
    {
        global $connexion;
        if ($orientation == "H")
            switch ($type_vessel) {
                case "porte-avion": // 5 cases
                    if ($position[0] < "G") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','5','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','H')");
                        return true;
                    }
                    return false;
                case "croiseur": // 4 cases
                    if ($position[0] < "H") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','4','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','H')");
                        return true;
                    }
                    return false;
                case "contre-torpilleur" || "sous-marin": // 3 cases
                    if ($position[0] < "I") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','3','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','H')");
                        return true;
                    }
                    return false;
                case "torpilleur": // 2 cases
                    if ($position[0] < "J") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','2','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','H')");
                        return true;
                    }
                    return false;
                default:
                    break;
            }
        if ($orientation == "V")
            switch ($type_vessel) {
                case "porte-avion": // 5 cases
                    if ($position[1] < "7") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','5','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','V')");
                        return true;
                    }
                    return false;
                case "croiseur": // 4 cases
                    if ($position[1] < "8") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','4','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','V')");
                        return true;
                    }
                    return false;
                case "contre-torpilleur" || "sous-marin": // 3 cases
                    if ($position[1] < "9") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','3','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','V')");
                        return true;
                    }
                    return false;
                case "torpilleur": // 2 cases
                    if ($position[1] < "10") {
                        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $this->id_joueur . "','" . $this->id_partie . "','porte-avion','2','https://fr.wikipedia.org/wiki/Porte-avions','" . $position . "','V')");
                        return true;
                    }
                    return false;
                default:
                    break;
            }
        return false;
    }

    /**
     * @return Grid
     */
    public function getAllyGrid()
    {
        return $this->ally_grid;
    }

    /**
     * @return Grid
     */
    public function getEnnemyGrid()
    {
        return $this->ennemy_grid;
    }

    /**
     * @param $opponent_id
     */
    public function setEnnemyGrid($opponent_id) {
        $this->ennemy_grid = new Grid($this->id_partie, $opponent_id, ENNEMY);
    }

    /**
     * @return string
     */
    public function getMyID()
    {
        $this->ally_grid->getIDJoueur();
    }

    /**
     * @return string
     */
    public function getOpponentID()
    {
        $this->ennemy_grid->getIDJoueur();
    }

    /**
     * @return int
     */
    public function getIDPartie()
    {
        return $this->id_partie;
    }
}