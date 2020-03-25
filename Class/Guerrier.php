<?php

require_once 'Hero.php';

class Guerrier extends Hero {

    protected $int_rage;

    public function __construct($int_pv = 200, $int_pv_actuel = 200, $int_attaque = 25, $int_experience = 0, $int_niveau = 1, $int_rage = 0, $int_defense = 10, $int_esquive = 10, $int_critique = 20) {
        $this->str_nom = "Guerrier";
        $this->str_image = "guerrier.jpg";
        $this->int_pv = $int_pv;
        $this->int_pv_actuel = $int_pv_actuel;
        $this->int_attaque = $int_attaque;
        $this->int_experience = $int_experience;
        $this->int_niveau = $int_niveau;
        $this->int_defense = $int_defense;
        $this->int_esquive = $int_esquive;
        $this->int_critique = $int_critique;
        $this->int_rage = $int_rage;

        $this->learn_sort("Justice", 1.1, "Inflige des dégats à l'ennemi et augmente votre rage de 25 points");
        $this->learn_sort("Taillade", 1.35, "Inflige d'important à l'ennemi, ignore 30% de l'armure et augmente votre rage de 50 points");
    }

    public static function withArray($arr_data) {        
        $obj_hero = new self($arr_data['int_pv'], $arr_data['int_pv_actuel'], $arr_data['int_attaque'], $arr_data['int_experience'], $arr_data['int_niveau'], $arr_data['int_rage']);
        return $obj_hero;
    }
 
    public function attaquer($obj_monstre, $id_sort) {
        $int_random = random_int(0, 100);
        if($int_random < $this->get_critique()) { // Gestion du critique 
            if($id_sort == 0) {
                $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense()) * 2;
                $this->set_rage($this->get_rage() + 25);
            } else if($id_sort == 1) {
                $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense() * 0.7) * 2;
                $this->set_rage($this->get_rage() + 50);
            }
        } else {
            if($id_sort == 0) {
                $int_degat = $this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense();
                $this->set_rage($this->get_rage() + 25);
            } else if($id_sort == 1) {
                $int_degat = $this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense() * 0.7;
                $this->set_rage($this->get_rage() + 50);
            }
        }

        // Gestion de la rage
        if($this->get_rage() >= 100) {
            $this->set_rage(0);
            $int_degat *= 3;
        }
        //Gestion de l'esquive
        $int_random = random_int(0, 100);
        if($int_random < $obj_monstre->get_esquive()) {
            $int_degat = 0;
        }

        if($int_degat > 0) {
            if($obj_monstre->get_pv_actuel() - $int_degat < 0) {
                $obj_monstre->set_pv_actuel(0);    
            } else {
                $obj_monstre->set_pv_actuel($obj_monstre->get_pv_actuel() - $int_degat);
            }
        }
    }

    public function set_rage($int_rage) {
        $this->int_rage = $int_rage;
    }

    public function get_rage() {
        return $this->int_rage;
    }
}