<?php

require_once 'Hero.php';

class Pretre extends Hero {

    private $passif;

    public function __construct() {
        $this->str_nom = "Pretre";
        $this->int_pv = 15;
        $this->int_attaque = 4;
        $this->int_experience = 0;
    }
}