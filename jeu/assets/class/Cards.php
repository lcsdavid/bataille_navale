<?php

class Cards
{

    function __construct()
    {

    }

    private

    public function pickUp($ally_grid, $ennemi_grid)
    {
        $rand = rand(1, 100);
        switch ($rand)
        {
            case ($rand<=25):
                //Missile
                break;
            case ($rand<=40):
                //Rajoue une fois
                break;
            case ($rand<=50):
                //Passe son tour
                break;
            case ($rand<=60):
                //Vide ou pas vide
                break;
            case ($rand<=63):
                //Meme pas mal
                break;
            case ($rand<=66):
                //bateau leurre
                break;
            case ($rand<=69):
                //mega bombe
                break;
            case ($rand<=72):
                //mauvaise manip
                break;
            case ($rand<=74):
                //sauvez willy
                break;
            case ($rand<=75):
                //etoile de la mort
                break;
            default:
                //missile
                break;
        }
    }
}