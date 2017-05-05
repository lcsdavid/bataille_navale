<?php

define('UNDEFINED', null);

define('WAITING', 0);
define('LAYVESSEL', 1);
define('WAITENNEMYLAYVESSEL', 2);
define('PLAYING', 3);
define('FINISHED', 4);

class Match
{
    /**
     * @var int
     */
    private $id_partie;

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
     * Tire sur la case $_POST['cell'].
     */
    public function fire()
    {
        global $connexion;
        $coord = (string)$_POST['cell'];
        $cell = $this->ennemy_grid->getCase($coord);
        if ($cell == 'sea') {
            $this->ennemy_grid->setCase('missed', $coord);
            mysqli_query($connexion, "INSERT INTO Tour (id_joueur, id_partie, resultat, coordonnee) VALUES ('" . $_SESSION['ID'] . "','" . $this->id_partie . "','missed','" . $coord . "')");
        } else {
            $this->ennemy_grid->setCase('hit', $coord);
            if (in_array($cell, $this->ennemy_grid->getArray()))
                mysqli_query($connexion, "INSERT INTO Tour (id_joueur, id_partie, resultat, coordonnee) VALUES ('" . $_SESSION['ID'] . "','" . $this->id_partie . "','hit','" . $coord . "')");
            else
                mysqli_query($connexion, "INSERT INTO Tour (id_joueur, id_partie, resultat, coordonnee) VALUES ('" . $_SESSION['ID'] . "','" . $this->id_partie . "','sunk','" . $coord . "')");
        }
        unset($_POST);
        return false;
    }

    /**
     * @param $type_vessel string
     * @param $position string
     * @param $orientation string
     * @return bool
     */
    public function layVessel($type_vessel, $position, $orientation)
    {
        global $connexion;
        $vessel = new Vessel($type_vessel);
        $letter = substr($position, 0, 1);
        $number = substr($position, 1);
        for ($i = 0; $i < $vessel->getLenght(); $i++) {
            if ($orientation == "vertical") {
                if ($this->ally_grid->getCase($letter . ($number + $i)) != "sea") {
                    unset($_POST);
                    return false;
                }
            } else
                if ($this->ally_grid->getCase(chr(ord($letter) + $i) . $number) != "sea") {
                    unset($_POST);
                    return false;
                }
        }
        /* On pose */
        mysqli_query($connexion, "INSERT INTO Navire (id_joueur, id_partie, type_nav, taille, reference, position, sens) VALUES ('" . $_SESSION['ID'] . "','" . $this->id_partie . "','" . $type_vessel . "','" . $vessel->getLenght() . "','" . $vessel->getReference() . "','" . $position . "','" . $orientation . "')");
        $this->ally_grid->addVessel($type_vessel, $position);
        for ($i = 0; $i < $vessel->getLenght(); $i++) {
            if ($orientation == "vertical")
                $this->ally_grid->setCase($type_vessel, $letter . ($number + $i));
            else
                $this->ally_grid->setCase($type_vessel, chr(ord($letter) + $i) . $number);
        }
        if (count($this->ally_grid->getVessels()) == 5)
            unset($_SESSION['orientation']);
        unset($_SESSION['vessel']);
        unset($_POST);
        return true;
    }

    /**
     * Fonction qui donne donne le formulaire de selection de bateau a afficher en fonction de la situation.
     * @return string
     */
    public function formVessel()
    {
        $list_vessel = [];
        if (!array_key_exists('porte-avion', $this->ally_grid->getVessels()))
            array_push($list_vessel, 'porte-avion');
        if (!array_key_exists('croiseur', $this->ally_grid->getVessels()))
            array_push($list_vessel, 'croiseur');
        if (!array_key_exists('contre-torpilleur', $this->ally_grid->getVessels()))
            array_push($list_vessel, 'contre-torpilleur');
        if (!array_key_exists('sous-marin', $this->ally_grid->getVessels()))
            array_push($list_vessel, 'sous-marin');
        if (!array_key_exists('torpilleur', $this->ally_grid->getVessels()))
            array_push($list_vessel, 'torpilleur');
        if (count($list_vessel) == 0) {
            $this->state = WAITENNEMYLAYVESSEL;
            return "";
        } elseif (count($list_vessel) == 1) {
            $pop = array_pop($list_vessel);
            $_SESSION['vessel'] = $pop;
            return "<span>Il ne reste plus que le " . $pop . ".</span>";
        } else {
            $result = "<form class='vesselForm' method='POST' action='./'>";
            if (isset($_SESSION['vessel']))
                $result .= "<span>Vous avez actuellement sélectionné le " . $_SESSION['vessel'] . ". Pour changer: </span>";
            else
                $result .= "<span>Choisissez le bateau que vous voulez placer: </span>";
            foreach ($list_vessel as $value) {
                $result .= "<input type='submit' name='vessel' value='" . $value . "'>";
            }
            $result .= "</form>";
            return $result;
        }
    }

    public function isVessemLayed()
    {
        global $connexion;
        if(mysqli_query($connexion, "SELECT COUNT(id_navire) FROM Navire WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $_SESSION['ID'] . "'")->fetch_row()[0] == 5)
            $this->state = WAITENNEMYLAYVESSEL;
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
        global $connexion;
        $rset = mysqli_query($connexion, "SELECT COUNT(id_navire) AS nav_count FROM Navire WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->ennemy_grid->getIDJoueur() . "'");
        if ($rset->fetch_row()[0] == 5)
            $this->state = PLAYING;
    }

    /**
     *
     */
    public function checkWinner()
    {
        global $connexion;
        if (mysqli_query($connexion, "SELECT COUNT(resultat) FROM Tour WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $_SESSION['ID'] . "' AND resultat = 'sunk'")->fetch_row()[0] == 5) {
            $this->state = FINISHED;
            mysqli_query($connexion, "UPDATE Partie SET vainqueur = '" . $_SESSION['ID'] . "' WHERE id_partie = '" . $this->id_partie . "'");
            mysqli_query($connexion, "INSERT INTO Etat_partie (id_partie, etat_partie) VALUES ('" . $this->id_partie . "','finished')");
        } else if (mysqli_query($connexion, "SELECT COUNT(resultat) FROM Tour WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->ennemy_grid->getIDJoueur() . "' AND resultat = 'sunk'")->fetch_row()[0] == 5) {
            $this->state = FINISHED;
            mysqli_query($connexion, "UPDATE Partie SET vainqueur = '" . $this->ennemy_grid->getIDJoueur() . "' WHERE id_partie = '" . $this->id_partie . "'");
            mysqli_query($connexion, "INSERT INTO Etat_partie (id_partie, etat_partie) VALUES ('" . $this->id_partie . "','finished')");
        }
    }

    /**
     * @return bool
     */
    public function isMyTurn()
    {
        global $connexion;
        if (mysqli_query($connexion, "SELECT id_joueur1 FROM Partie WHERE id_partie = '" . $this->id_partie . "'")->fetch_row()[0] == $_SESSION['ID']) {
            if (mysqli_query($connexion, "SELECT COUNT(id_tour) FROM Tour WHERE id_partie = '" . $this->id_partie . "'")->fetch_row()[0] % 2 == 0)
                return true;
            else
                return false;
        } else {
            if (mysqli_query($connexion, "SELECT COUNT(id_tour) FROM Tour WHERE id_partie = '" . $this->id_partie . "'")->fetch_row()[0] % 2 == 1)
                return true;
            else
                return false;
        }
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