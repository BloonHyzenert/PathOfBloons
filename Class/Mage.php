<?php

require_once 'Hero.php';

class Mage extends Hero {

    protected $int_mana;

    public function __construct() {
        $this->str_nom = "Mage";
        $this->str_image = "mage.jpg";
        $this->int_pv = 150;
        $this->int_pv_actuel = 150;
        $this->int_attaque = 30;
        $this->int_experience = 0;
        $this->int_niveau = 1;
        $this->int_defense = 0;
        $this->int_esquive = 20;
        $this->int_critique = 30;
        $this->mana = 100;
    }

    public static function withArray($arr_data) {
        $obj_hero = new self();
        $obj_hero->set_pv_actuel($arr_data['int_pv_actuel']);
        $obj_hero->set_attaque($arr_data['int_attaque']);
        return $obj_hero;
    }
}