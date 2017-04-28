<?php

define("ALLY", 0);
define("ENNEMY", 1);

class Grid
{
    private $array = [""];
    private $id_partie;
    private $id_joueur;
    private $alignment;

    /*function __construct(){

        for ($row = 'A'; $row <= 'J'; $row++) {
            for ($column = 1; $column <= 10; $column++) {
                $cell = $row . (string)$column;
                $this->array[$cell] = "sea";
            }
        }
    }*/

    function __construct($id_partie, $id_joueur, $alignment)
    {
        $this->id_partie = $id_partie;
        $this->id_joueur = $id_joueur;
        $this->alignment = $alignment;
        for ($row = 'A'; $row <= 'J'; $row++) {
            for ($column = 1; $column <= 10; $column++) {
                $cell = $row . (string)$column;
                $this->array[$cell] = "sea";
            }
        }
    }

    public function loadBoats()
    {
        global $connexion;
        $rset = mysqli_query($connexion, "SELECT * FROM Navire WHERE id_joueur = '" . $this->id_joueur . "' ");

    }

    public function reload()
    {
        global $connexion;
        $rset = mysqli_query($connexion, "SELECT tir FROM Tour WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->id_joueur . "'");
        for ($i = 0; $i < $rset->num_rows; $i++) {
            $row = $rset->fetch_row();
            if ($this->array[$row[0]] == "sea")
                $this->array[$row[0]] = "missed";
            else
                $this->array[$row[0]] = "hit";
        }
    }

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
}