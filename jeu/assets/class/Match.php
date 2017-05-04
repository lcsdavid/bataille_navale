<?php

define('UNDEFINED', -1);

define('WAITING', 0);
define('LAYVESSEL', 1);
define('PLAYING', 2);
define('FINISHED', 10);

class Match
{
    /**
     * @var int
     */
    private $id_partie = -1;

    /**
     * @var Grid
     */
    private $ally_grid;

    /**
     * @var int
     */
    private $state;

    /**
     * @var Grid
     */
    private $ennemy_grid;

    function __construct($id_partie)
    {
        if ($id_partie == -1) {
            $this->create();
            $this->ally_grid = new Grid($this->id_partie, $_SESSION['ID'], ALLY);
            $this->ennemy_grid = new Grid($this->id_partie, UNDEFINED, ENNEMY);
        } else {
            $this->join();
            $this->ally_grid = new Grid($id_partie, $_SESSION['ID'], ALLY);
            $this->ennemy_grid = new Grid($id_partie, UNDEFINED, ENNEMY);
        }
        $this->state = WAITING;
    }

    /**
     * Crée une partie (SQL)
     */
    private function create()
    {
        global $connexion;
        mysqli_query($connexion, "INSERT INTO Etat_partie (id_partie, etat_partie) SELECT id_partie, ('cancelled') AS etat_partie FROM Partie WHERE id_partie NOT IN (SELECT id_partie FROM Etat_partie) ");
        mysqli_query($connexion, "INSERT INTO Partie (id_joueur1) VALUES ('" . $_SESSION['ID'] . "')");
        $this->id_partie = mysqli_query($connexion, "SELECT id_partie FROM Partie WHERE id_joueur1 = '" . $_SESSION['ID'] . "' LIMIT 1")->fetch_row()[0];
    }

    /**
     * Rejoinds la partie (SQL)
     */
    private function join()
    {
        global $connexion;
        $id_joueur1 = mysqli_query($connexion, "SELECT id_joueur1 FROM Partie WHERE id_partie = '" . $this->id_partie . "'")->fetch_row()[0];
        if ($_SESSION['ID'] != $id_joueur1) {
            mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '" . $_SESSION['ID'] . "' WHERE id_partie = '" . $this->id_partie . "'");
            setEnnemyGrid();
        }
    }

    /**
     * Quitte la partie.
     */
    public function quit()
    {
        global $connexion;
        mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '" . $_SESSION['ID'] . "' WHERE id_partie = '" . $this->id_partie . "'");
        mysqli_query($connexion, "UPDATE Etat_partie SET etat_partie = 'cancelled' WHERE id_partie = '" . $this->id_partie . "'");
        header("../");
        unset($_SESSION['partie']);
    }

    /**
     * @param $type_vessel
     * @param $position
     * @param $orientation = "H" ou "V"
     * @return bool
     */
    public function layVessel($type_vessel, $position, $orientation)
    {
        $vessel = new Vessel($type_vessel);
        global $connexion;
        for ($i = 0; $i < $vessel->getLenght(); $i++) {
            if ($orientation == "H") if ($this->ally_grid->getCase($position[0] . ($position[1] + $i)) != "sea")
                return false;
            else if ($this->ally_grid->getCase(($position[0] + $i) . $position[1]) != "sea")
                return false;
        }
        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $_SESSION['ID'] . "','" . $this->id_partie . "','" . $type_vessel . "','" . $vessel->getLenght() . "','" . $vessel->getReference() . "','" . $position . "','" . $orientation . "')");
        return true;
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
     * Mutateur de la grille ennemi.
     */
    public function setEnnemyGrid()
    {
        global $connexion;
        $row = mysqli_query($connexion, "SELECT id_joueur1 ,id_joueur2 FROM Partie WHERE id_partie = '" . $this->id_partie . "'")->fetch_row();
        if ($row[0] == $_SESSION['id'])
            $this->ennemy_grid = new Grid($this->id_partie, $row[1], ENNEMY);
        else {
            $this->ennemy_grid = new Grid($this->id_partie, $row[0], ENNEMY);
            $this->state = LAYVESSEL;
        }

    }

    /**
     * @return string
     */
    public function getMyID()
    {
        return $this->ally_grid->getIDJoueur();
    }

    /**
     * @return string
     */
    public function getOpponentID()
    {
        return $this->ennemy_grid->getIDJoueur();
    }

    /**
     * @return int
     */
    public function getIDPartie()
    {
        return $this->id_partie;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }
}

?>