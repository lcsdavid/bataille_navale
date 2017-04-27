<?php

class Grid
{
    private $array = [""];
    private $id_joueur;
    private $id_partie;

    function Grid() {
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
        $rset = mysqli_query($connexion,"SELECT * ");

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