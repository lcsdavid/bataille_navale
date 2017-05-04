<?php

define('UNDEFINED', -1);
define('ENNEMY', 0);
define('ALLY', 1);

class Grid
{
    /**
     * @var array
     */
    private $array = [""];
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
        global $connexion;
        if ($this->alignment == ALLY) {
            $rset = mysqli_query($connexion, "SELECT type_nav, position, sens, taille FROM Navire WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->id_joueur . "'");
            for ($i = 0; $i < $rset->num_rows; $i++) {
                $row = $rset->fetch_row();
                $pos = $row[1];
                for ($j = 0; $j < $row[3]; $j++) {
                    if ($row[2] == 'H')
                        $pos = $pos[0] . ($pos[1] + $j);
                    if ($row[2] == 'V')
                        $pos = ($pos[0] + $j) . $pos[1];
                    $this->array[$pos] = $row[0];
                }
            }
        }
        $rset = mysqli_query($connexion, "SELECT tir FROM Tour WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->id_joueur . "'");
        while ($row = $rset->fetch_row()) {
            $row = $rset->fetch_row();
            if ($this->array[$row[0]] == "sea")
                $this->array[$row[0]] = "missed";
            else
                $this->array[$row[0]] = "hit";
        }
    }

    /**
     *
     */
    public function display()
    {
        for ($row = 1; $row <= 10; $row++) {
            echo "<tr><td class='cell coord'>" . $row . "</td>";
            for ($column = 'A'; $column <= 'J'; $column++) {
                $cell = $column . $row;
                echo "<td class='cell " . $this->array[$cell] . "'></td>";
            }
        }
        return $this;
    }

    /**
     *
     */
    public function displayForm()
    {
        for ($row = 1; $row <= 10; $row++) {
            echo "<tr><td class='cell coord'>" . $row . "</td>";
            for ($column = 'A'; $column <= 'J'; $column++) {
                $cell = $column . $row;
                echo "<td class='cell " . $this->array[$cell] . "'><form class='partie' method='POST' action='../partie/'><input type='hidden' name='cell' value='" . $cell . "'><input type='image' name='click'></form></td>";
            }
        }
    }

    /**
     * @param $pos
     * @return string
     */
    public function getCase($pos) {
        return $this->array[$pos];
    }

    public function setCase($value, $pos) {
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
}

?>