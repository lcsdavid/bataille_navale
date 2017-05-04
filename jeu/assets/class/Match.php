<?php

define('UNDEFINED', null);

define('WAITING', 0);
define('LAYVESSEL', 1);
define('WAITENNEMYLAYVESSEL', 2);
define('PLAYING', 3);
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
            $this->id_partie = $id_partie;
            $this->ally_grid = new Grid($id_partie, $_SESSION['ID'], ALLY);
            $this->ennemy_grid = new Grid($id_partie, UNDEFINED, ENNEMY);
            $this->join();
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
        $this->id_partie = mysqli_query($connexion, "SELECT id_partie FROM Partie WHERE id_joueur1 = '" . $_SESSION['ID'] . "' ORDER BY id_partie DESC")->fetch_row()[0];
    }

    /**
     * Rejoinds la partie (SQL)
     */
    private function join()
    {
        global $connexion;
        $row = mysqli_query($connexion, "SELECT id_joueur1, id_joueur2 FROM Partie WHERE id_partie = '" . $this->id_partie . "'")->fetch_row();
        if ($_SESSION['ID'] != $row[0]) {
            mysqli_query($connexion, "UPDATE Partie SET id_joueur2 = '" . $_SESSION['ID'] . "' WHERE id_partie = '" . $this->id_partie . "'");
            $this->getEnnemyGrid()->setIDJoueur($row[0]);
            $this->state = LAYVESSEL;
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
        $this->ally_grid->getVessels()[$type_vessel] = $position;
        if (isset($_SESSION['orientation']))
            unset($_SESSION['orientation']);
        if (isset($_SESSION['vessel']))
            unset($_SESSION['vessel']);
        return true;
    }

    /**
     * Fonction qui donne donne le formulaire de selection de bateau a afficher en fonction de la situation.
     * @return string
     */
    public function formVessel()
    {
        $result = "";
        if ($this->getAllyGrid()->getVessels()["porte-avion"] == null)
            $result = $result . "<input type='submit' name='vessel' value='porte-avion'>";
        if ($this->getAllyGrid()->getVessels()["croiseur"] == null)
            $result = $result . "<input type='submit' name='vessel' value='croiseur'>";
        if ($this->getAllyGrid()->getVessels()["contre-torpilleur"] == null)
            $result = $result . "<input type='submit' name='vessel' value='contre-torpilleur'>";
        if ($this->getAllyGrid()->getVessels()["sous-marin"] == null)
            $result = $result . "<input type='submit' name='vessel' value='sous-marin'>";
        if ($this->getAllyGrid()->getVessels()["torpilleur"] == null)
            $result = $result . "<input type='submit' name='vessel' value='torpilleur'>";
        /* VIDE */
        if ($result = "")
            $this->state = WAITENNEMYLAYVESSEL;
        /* SESSION */
        if (isset($_SESSION['vessel']))
            $result = "<form class='vesselForm' method='POST' action='./'><span>Vous avez actuellement sélectionné le " . $_SESSION['vessel'] . ". Pour changer: </span>" . $result . "</form>";
        else
            $result = "<form class='vesselForm' method='POST' action='./'>" . $result . "</form>";
        return $result;
    }

    /**
     * Routine quand on attend l'adversaire.
     */
    public function checkWait()
    {
        global $connexion;
        $row = mysqli_query($connexion, "SELECT id_joueur1, id_joueur2 FROM Partie WHERE id_partie = '" . $this->id_partie . "'")->fetch_row();
        if ($row[1] == null) {
            return;
        } else if ($row[0] == $_SESSION['ID'])
            $this->getEnnemyGrid()->setIDJoueur($row[1]);
        else $this->getEnnemyGrid()->setIDJoueur($row[0]);
        $this->state = LAYVESSEL;
    }

    /**
     * Routine quand on attend que l'adversaire est posé tout ses bateaux.
     */
    public function checkWaitEnnemyVessel()
    {

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