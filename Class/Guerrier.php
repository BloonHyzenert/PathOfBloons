<?php

require_once 'Hero.php';

class Guerrier extends Hero {

    public function __construct() {
        $this->str_nom = "Guerrier";
        $this->int_pv = 20;
        $this->int_attaque = 3;
        $this->int_experience = 0;
    }
    
}