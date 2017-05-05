<?php

class Cards
{
    private $pathImage;

    function __construct(){
        $this->pathImage = "../images/cartes/";
    }


    public function pickUp()
    {
        $rand = rand(0, 100);
        switch ($rand)
        {
            case ($rand<=25):
                $this->pathImage .= "carte1.png";
                //Missile
                break;
            case ($rand<=40):
                $this->pathImage .= "carte2.png";
                //Rajoue une fois
                break;
            case ($rand<=50):
                $this->pathImage .= "carte9.png";
                //Passe son tour
                break;
            case ($rand<=60):
                $this->pathImage .= "carte3.png";
                //Vide ou pas vide
                break;
            case ($rand<=63):
                $this->pathImage .= "carte4.png";
                //Meme pas mal
                break;
            case ($rand<=66):
                $this->pathImage .= "carte5.png";
                //bateau leurre
                break;
            case ($rand<=69):
                $this->pathImage .= "carte7.png";
                //mega bombe
                break;
            case ($rand<=72):
                $this->pathImage .= "carte10.png";
                //mauvaise manip
                break;
            case ($rand<=74):
                $this->pathImage .= "carte6.png";
                //sauvez willy
                break;
            case ($rand<=75):
                $this->pathImage .= "carte8.png";
                //etoile de la mort
                break;
            default:
                $this->pathImage .= "carte1.png";
                //missile
                break;
        }
    }

    /**
     * @return string
     */
    public function getPathImage()
    {
        return $this->pathImage;
    }

    private function Missile()
    {

    }

    private function Rejoue_une_fois()
    {

    }

    private function Vide_ou_pas_vide()
    {

    }

    private function Meme_pas_mal()
    {

    }

    private function Bateau_leurre()
    {

    }

    private function Sauvez_Willy()
    {

    }

    private function Mega_bombe()
    {

    }

    private function Etoile_de_la_mort()
    {

    }

    private function Passe_son_tour()
    {

    }

    private function Mauvaise_manip()
    {

    }
}

?>