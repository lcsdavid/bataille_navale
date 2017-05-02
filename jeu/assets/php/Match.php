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
        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $_SESSION['id'] . "','" . $this->id_partie . "','" . $type_vessel . "','" . $vessel->getLenght() . "','" . $vessel->getReference() . "','" . $position . "','" . $orientation . "')");
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
     * @param $opponent_id
     */
    public function setEnnemyGrid($opponent_id)
    {
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