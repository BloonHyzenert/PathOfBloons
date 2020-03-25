<?php

require_once 'Hero.php';

class Pretre extends Hero {
    
    protected $int_energie;

    public function __construct() {
        $this->str_nom = "Pretre";
        $this->str_image = "pretre.jpg";
        $this->int_pv = 175;
        $this->int_pv_actuel = 175;
        $this->int_attaque = 25;
        $this->int_experience = 0;
        $this->int_niveau = 1;
        $this->int_defense = 5;
        $this->int_esquive = 20;
        $this->int_critique = 30;
        $this->int_energie = 0;
    }

    public static function withArray($arr_data) {
        $obj_hero = new self();
        $obj_hero->set_pv_actuel($arr_data['int_pv_actuel']);
        $obj_hero->set_attaque($arr_data['int_attaque']);
        return $obj_hero;
    }
}