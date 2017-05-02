<?php

class Vessel
{
    private $type;
    private $reference;
    private $lenght;

    public function __construct($type)
    {
        $this->type = $type;
        switch($this->type)
        {
            case('porte_avion'):
                $this->reference = "https://fr.wikipedia.org/wiki/Porte-avions";
                $this->lenght = 5;
                break;
            case('croiseur'):
                $this->reference = "https://fr.wikipedia.org/wiki/Croiseur";
                $this->lenght = 4;
                break;
            case('contre-torpilleur'):
                $this->reference = "https://fr.wikipedia.org/wiki/Destroyer";
                $this->lenght = 3;
                break;
            case('sous-marin'):
                $this->reference = "https://fr.wikipedia.org/wiki/Sous-marin";
                $this->lenght = 3;
                break;
            case('topilleur'):
                $this->reference = "https://fr.wikipedia.org/wiki/Torpilleur";
                $this->lenght = 2;
                break;
            default:
                $this->reference = "https://fr.wikipedia.org/wiki/Adolf_Hitler";
                $this->lenght = 0;
                break;
        }
    }

    /**
     * @return int
     */
    public function getLenght()
    {
        return $this->lenght;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }
}