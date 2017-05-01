<?php

define("ALLY", 0);
define("ENNEMY", 1);

class Partie
{
    private $id_partie;
    private $ally_grid;
    private $ennemy_grid;

    function __construct($id_partie, $my_id, $opponent_id)
    {
        $this->id_partie = $id_partie;
        $this->ally_grid = new Grid($id_partie, $my_id, ALLY);
        $this->ennemy_grid = new Grid($id_partie, $opponent_id, ENNEMY);
    }

    static public function create()
    {
        global $connexion;
        mysqli_query($connexion, "UPDATE Partie SET etat_partie = 'cancelled' WHERE id_joueur1 = '" . $_SESSION['id'] . "' AND etat_partie = 'waiting'");
        mysqli_query($connexion, "INSERT INTO Partie (id_joueur1, id_joueur2,  etat , vainqueur) VALUES ('" . $_SESSION['id'] . "',NULL, 'waiting', NULL)");
    }

    static public function join($id_partie)
    {
        global $connexion;
        mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '" . $_SESSION['id'] . "', etat = 'en cours' WHERE id_partie = '" . $id_partie . "'");
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
        $this->ennemy_grid->getIdJoueur();
    }

}

class Grid
{
    private $array = [""];
    private $id_partie;
    private $id_joueur;
    private $alignment;

    /**
     * Grid constructor.
     * @param $id_partie
     * @param $id_joueur
     * @param $alignment
     */
    function __construct($id_partie, $id_joueur, $alignment)
    {
        $this->id_partie = $id_partie;
        $this->id_joueur = $id_joueur;
        $this->alignment = $alignment;
        for ($row = 1; $row <= 10; $row++) {
            for ($column = 'A'; $column <= 'J'; $column++) {
                $cell = $column . $row;
                $this->array[$cell] = "sea";
            }
        }
    }

    /**
     * @return bool
     */
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
     * Recharge complètement la grille de jeu.
     */
    public function reload()
    {
        global $connexion;
        if ($this->alignment == ALLY) {
            $rset = mysqli_query($connexion, "SELECT type_nav, position, sens, taille FROM Navire WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->id_joueur . "'");
            for ($i = 0; $i < $rset->num_rows; $i++) {
                $row = $rset->fetch_row();
                $pos = $row[1];
                for ($j = 0; $j < $row[3]; $j++) {
                    $this->array[$pos] = $row[0];
                    if ($row[2] == 'H')
                        $pos = $pos[0] . ($pos[1] + 1);
                    if ($row[2] == 'V')
                        $pos = ($pos[0] + 1) . $pos[1];
                }
            }
        }
        $rset = mysqli_query($connexion, "SELECT tir FROM Tour WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->id_joueur . "'");
        for ($i = 0; $i < $rset->num_rows; $i++) {
            $row = $rset->fetch_row();
            if ($this->array[$row[0]] == "sea")
                $this->array[$row[0]] = "missed";
            else
                $this->array[$row[0]] = "hit";
        }

    }

    /**
     * @return $this
     */
    public function display()
    {
        for ($row = 'A'; $row <= 'J'; $row++) {
            echo "<tr><td class='cell coord'>" . $row . "</td>";
            for ($column = 1; $column <= 10; $column++) {
                $cell = $row . (string)$column;
                echo "<td class='cell " . $this->array[$cell] . "'><a href='#" . $cell . "'></a></td>";
            }
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getIDJoueur()
    {
        return $this->id_joueur;
    }
}