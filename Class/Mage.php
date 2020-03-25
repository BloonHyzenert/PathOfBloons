<?php

require_once 'Hero.php';

class Mage extends Hero {

    private $passif;

    public function __construct() {
        $this->str_nom = "Mage";
        $this->str_image = "mage.jpg";
        $this->int_pv = 10;
        $this->int_pv_actuel = 200;
        $this->int_attaque = 5;
        $this->int_experience = 0;
        $this->int_defense = 5;
        $this->int_esquive = 10;
        $this->int_critique = 20;
    }

    public static function withArray($arr_data) {
        $obj_hero = new self();
        $obj_hero->set_pv_actuel($arr_data['int_pv_actuel']);
        $obj_hero->set_attaque($arr_data['int_attaque']);
        return $obj_hero;
    }
}