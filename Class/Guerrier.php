<?php

require_once 'Hero.php';

class Guerrier extends Hero {

    public function __construct() {
        $this->str_nom = "Guerrier";
        $this->str_image = "guerrier.jpg";
        $this->int_pv = 20;
        $this->int_attaque = 3;
        $this->int_experience = 0;
        $this->int_defense = 5;
        $this->int_esquive = 10;
        $this->int_critique = 20;
    }
    
}