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

    function create()
    {
        global $connexion;
        mysqli_query($connexion, "UPDATE Partie SET etat_partie = 'cancelled' WHERE id_joueur1 = '" . $_SESSION['id'] . "' AND etat_partie = 'waiting'");
        mysqli_query($connexion, "INSERT INTO Partie (id_joueur1, id_joueur2,  etat , vainqueur) VALUES ('" . $_SESSION['id'] . "',NULL, 'waiting', NULL)");
    }

}

class Grid
{
    private $array = [""];
    private $id_partie;
    private $id_joueur;
    private $alignment;

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
        $rset = mysqli_query($connexion, "SELECT * FROM Navire WHERE id_joueur = '" . $this->id_joueur . "' AND id_partie = '" . $this->id_partie . "'");

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