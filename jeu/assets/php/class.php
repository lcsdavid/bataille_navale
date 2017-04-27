<?php

class Grid
{
    private $array = [""];
    private $id_partie = 1;
    private $id_joueur = 21;

    function Grid()
    {
        $this->init()->load();
    }

    public function init()
    {
        for ($row = 'A'; $row <= 'J'; $row++) {
            for ($column = 1; $column <= 10; $column++) {
                $cell = $row . (string)$column;
                $this->array[$cell] = "sea";
            }
        }
        return $this;
    }

    public function load()
    {
        global $connexion;
        $rset = mysqli_query($connexion, "SELECT tir, resultat FROM Tour WHERE id_partie = '" . $this->id_partie . "' AND id_joueur = '" . $this->id_joueur . "'");
        for ($i = 0; $i < $rset->num_rows; $i++) {
            $row = $rset->fetch_row();
            printf('Ligne: ');
            printf($row[0]);
            printf(' Resultat: ');
            printf($row[1]);
            if ($row[1]) {
                if ($this->array[$row[0]] == "sea") {
                    $this->array[$row[0]] = "missed";
                } else {
                    $this->array[$row[0]] = "hit";
                }
            }
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