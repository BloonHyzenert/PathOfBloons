<?php

require_once 'Hero.php';

class Guerrier extends Hero {

    public function __construct() {
        $this->str_nom = "Guerrier";
        $this->str_image = "guerrier.jpg";
        $this->int_pv = 200;
        $this->int_attaque = 20;
        $this->int_experience = 0;
        $this->int_defense = 5;
        $this->int_esquive = 10;
        $this->int_critique = 20;
    }

    public function withArray($arr_data) {
        $obj_hero = new self();
        $obj_hero->set_pv($arr_data['int_pv']);
        $obj_hero->set_attaque($arr_data['int_attaque']);
        return $obj_hero;
    }

}