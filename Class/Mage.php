<?php

require_once 'Hero.php';

class Mage extends Hero {

    private $passif;

    public function __construct() {
        $this->str_nom = "MAGE";
        $this->int_pv = 10;
        $this->int_attaque = 5;
        $this->int_experience = 0;
    }
}