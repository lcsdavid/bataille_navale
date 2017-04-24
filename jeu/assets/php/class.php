<?php

class Grid
{
    private $array = [""];

    public function init()
    {
        for ($row = 'A'; $row <= 'J'; $row++) {
            for ($column = 1; $column <= 10; $column++) {
                printf($row);
                printf($column);
                $cell = $row . (string)$column;
                $array[$cell] = "Vide.";
            }
        }
    }

    public function reload()
    {

    }

    public function display()
    {
        $old_key = "";
        foreach ($this->array as $key => $value) {
            if ($old_key == $key)
                echo "<tr><td class='cell coord'>" . $key . "</td>";
            echo "<td class='cell " . $value . "'><a href='#" . $key . "'></a></td>";
            if ($old_key == $key) {
                echo "</tr>";
                $old_key = $key;
            }
        }
    }

}