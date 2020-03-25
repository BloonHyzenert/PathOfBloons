<?php

require_once 'Hero.php';

class Guerrier extends Hero {

    protected $int_rage;

    public function __construct() {
        $this->str_nom = "Guerrier";
        $this->str_image = "guerrier.jpg";
        $this->int_pv = 200;
        $this->int_pv_actuel = 200;
        $this->int_attaque = 20;
        $this->int_experience = 0;
        $this->int_niveau = 1;
        $this->int_defense = 10;
        $this->int_esquive = 10;
        $this->int_critique = 20;
        $this->int_rage = 0;

        $this->learn_sort("Justice", 1, "Inflige des dégats à l'ennemi et augmente votre rage de 10 points");
        $this->learn_sort("Spin", 1.25, "Inflige des dégats à l'ennemi et augmente votre rage de 30 points");
    }

    public static function withArray($arr_data) {
        $obj_hero = new self();
        $obj_hero->set_pv_actuel($arr_data['int_pv_actuel']);
        $obj_hero->set_attaque($arr_data['int_attaque']);
        return $obj_hero;
    }
}