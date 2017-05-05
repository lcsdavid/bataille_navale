<?php

define('UNDEFINED', -1);
define('ENNEMY', 0);
define('ALLY', 1);

class Grid
{
    /**
     * @var array
     */
    private $array;
    /**
     * @var string
     */
    private $id_partie;

    /**
     * @var string
     */
    private $id_joueur;

    /**
     * @var int
     */
    private $alignment;

    /**
     * @var array
     */
    private $vessels;

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
     * Recharge complètement la grille de jeu.
     */
    public function reload()
    {
        for ($row = 1; $row <= 10; $row++) {
            for ($column = 'A'; $column <= 'J'; $column++) {
                $cell = $column . $row;
                $this->array[$cell] = "sea";
            }
        }
        global $connexion;
        if ($this->alignment == ALLY)
            $id_joueur = $_SESSION['partie']->getEnnemyGrid()->getIDJoueur();
        else
            $id_joueur = $_SESSION['ID'];
        $rset = mysqli_query($connexion, "SELECT type_nav, position, sens, taille FROM Navire WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $id_joueur . "'");
        while($row = $rset->fetch_row()) {
            $letter = $row[1][0];
            $number = substr($row[1],1);
            for ($i = 0; $i < $row[3]; $i++) {
                if ($row[2] == 'horizontal')
                    $pos = chr(ord($letter) + $i) . $number;
                else
                    $pos = $letter . ($number + $i);
                $this->array[$pos] = $row[0];
            }
        }
        $rset = mysqli_query($connexion, "SELECT resultat, coordonnee FROM Tour WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->id_joueur . "'");
        if (mysqli_num_rows($rset) > 0)
            while ($row = $rset->fetch_row()) {
                if ($this->array[$row[1]] == "sea")
                    $this->array[$row[1]] = "missed";
                else
                    $this->array[$row[1]] = "hit";
            }
    }

    /**
     *
     */
    public function display()
    {
        if ($this->alignment == ALLY) {
            for ($row = 1; $row <= 10; $row++) {
                echo "<tr><td class='cell coord'>" . $row . "</td>";
                for ($column = 'A'; $column <= 'J'; $column++) {
                    $cell = $column . $row;
                    echo "<td class='cell " . $this->array[$cell] . "'></td>";
                }
            }
        } else {
            for ($row = 1; $row <= 10; $row++) {
                echo "<tr><td class='cell coord'>" . $row . "</td>";
                for ($column = 'A'; $column <= 'J'; $column++) {
                    $cell = $column . $row;
                    if ($this->array[$cell] == "sea" || $this->array[$cell] == "missed" || $this->array[$cell] == "hit")
                        echo "<td class='cell " . $this->array[$cell] . "'></td>";
                    else
                        echo "<td class='cell sea'></td>";
                }
            }
        }
    }

    /**
     *
     */
    public function displayForm()
    {
        if ($this->alignment == ALLY) {
            for ($row = 1; $row <= 10; $row++) {
                echo "<tr><td class='cell coord'>" . $row . "</td>";
                for ($column = 'A'; $column <= 'J'; $column++) {
                    $cell = $column . $row;
                    if ($this->array[$cell] != "sea")
                        echo "<td class='cell " . $this->array[$cell] . "'></td>";
                    else
                        echo "<td class='cell " . $this->array[$cell] . "'><form method='POST' action='./'><input type='hidden' name='cell' value='" . $cell . "'><input type='submit' name='click'></form></td>";
                }
            }
        } else {
            for ($row = 1; $row <= 10; $row++) {
                echo "<tr><td class='cell coord'>" . $row . "</td>";
                for ($column = 'A'; $column <= 'J'; $column++) {
                    $cell = $column . $row;
                    if($this->array[$cell] == "missed" || $this->array[$cell] == "hit")
                        echo "<td class='cell " . $this->array[$cell] . "'></td>";
                    else
                        echo "<td class='cell sea'><form method='POST' action='./'><input type='hidden' name='cell' value='" . $cell . "'><input type='submit' name='click'></form></td>";
                }
            }
        }
    }

    /**
     * @param $pos
     * @return string
     */
    public function getCase($pos)
    {
        return $this->array[$pos];
    }

    /**
     * @param $value
     * @param $pos
     */
    public function setCase($value, $pos)
    {
        $this->array[$pos] = $value;
    }

    /**
     * @return string
     */
    public function getIDJoueur()
    {
        return $this->id_joueur;
    }

    /**
     * @param string $id_joueur
     */
    public function setIDJoueur($id_joueur)
    {
        $this->id_joueur = $id_joueur;
    }

    /**
     * @return int
     */
    public function getAlignment()
    {
        return $this->alignment;
    }

    /**
     * @param $vessel string
     * @param $pos string
     */
    public function addVessel($vessel, $pos)
    {
        $this->vessels[$vessel] = $pos;
    }

    /**
     * @return array
     */
    public function getVessels()
    {
        return $this->vessels;
    }

    /**
     * @return array
     */
    public function getArray()
    {
        return $this->array;
    }
}

?>