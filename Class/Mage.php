<?php

require_once 'Hero.php';

class Mage extends Hero {

    protected $int_mana_max;
    protected $int_mana_actuel;

    public function __construct($int_pv = 150, $int_pv_actuel = 150, $int_attaque = 30, $int_experience = 0, $int_niveau = 1, $int_defense = 0, $int_critique = 20, $int_mana_max = 100, $int_mana_actuel = 100) {
        $this->str_nom = "Mage";
        $this->str_image = "mage.jpg";
        $this->int_pv = $int_pv;
        $this->int_pv_actuel = $int_pv_actuel;
        $this->int_attaque = $int_attaque;
        $this->int_experience = $int_experience;
        $this->int_niveau = $int_niveau;
        $this->int_defense = $int_defense;
        $this->int_esquive = 15;
        $this->int_critique = $int_critique;
        $this->int_mana_max = $int_mana_max;
        $this->int_mana_actuel = $int_mana_actuel;

        $this->learn_sort("Engelure", 1.3, "Inflige des dégats à l'ennemi, augmente votre mana de 15 points (A une faible chance de gelée pour 1 tour)", "./ressources/Engelure.png");
        $this->learn_sort("Blizzard", 1.85, "Inflige des gros dégats à l'ennemi, coûte 40 points de mana (Gêle pendant 1 tour)", "./ressources/Blizzard.png");
    }

    public static function withArray($arr_data) {
        $obj_hero = new self($arr_data['int_pv'], $arr_data['int_pv_actuel'], $arr_data['int_attaque'], $arr_data['int_experience'], $arr_data['int_niveau'], $arr_data['int_defense'], $arr_data['int_critique'], $arr_data['int_mana_max'], $arr_data['int_mana_actuel']);
        return $obj_hero;
    }

    public function attaquer($obj_monstre, $id_sort) {
        $bln_ok = true;
        $int_degat = 0;
        $str_effet = '';

        if($id_sort == 0) {
            $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense());
            if ($this->get_mana_actuel() + 15 > 100)  {
                $this->set_mana_actuel(100);    
            } else {
                $this->set_mana_actuel($this->get_mana_actuel() + 15);
            }
        } else if($id_sort == 1) {
            if ($this->get_mana_actuel() < 40) {
                $bln_ok = false;
            } else {
                $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense());
                if ($this->get_mana_actuel() - 40 < 0)  {
                    $this->set_mana_actuel(0);    
                } else {
                    $this->set_mana_actuel($this->get_mana_actuel() - 40);
                }
            }
        }
        
        if($bln_ok) {
            // Gestion des degats critique
            $int_random = random_int(0, 100);
            if($int_random < $this->get_critique()) {
                $int_degat *= 2;
            }

            // Gestion de l'esquive
            $int_random = random_int(0, 100);
            if($int_random < $obj_monstre->get_esquive()) {
                $int_degat = -1;
                return ["message" => "Le " . $obj_monstre->get_nom() . " esquiver votre attaque !!"];
            } else {
                // Gestion du gêle
                $int_random = random_int(0, 100);
                if($id_sort == 0 && $int_random < 15) {
                    $str_effet = "Vous avez gelé l'ennemi !! ";
                } else if ($id_sort == 1) {
                    $str_effet = "Vous avez gelé l'ennemi !! "; 
                }
            }

            if($int_degat > 0) {
                if($obj_monstre->get_pv_actuel() - $int_degat < 0) {
                    $obj_monstre->set_pv_actuel(0);    
                } else {
                    $obj_monstre->set_pv_actuel(round($obj_monstre->get_pv_actuel() - $int_degat, 0));
                }
                if($str_effet != '') {
                    return ["message" => "Le " . $obj_monstre->get_nom() . " a perdu " . $int_degat . " points de vie", "effet" => $str_effet];
                } else {
                    return ["message" => "Le " . $obj_monstre->get_nom() . " a perdu " . $int_degat . " points de vie"];
                }
            } else if ($int_degat != -1) {
                $int_degat = 0;
                return ["message" => "Votre attaque n'est pas assez efficace"];
            }
        } else {
            return ["error" => "Pas assez de mana pour lancer le sort"];
        }
    }

    public function set_mana_max($int_mana) {
        $this->int_mana_max = $int_mana;
    }

    public function get_mana_max() {
        return $this->int_mana_max;
    }

    public function set_mana_actuel($int_mana) {
        $this->int_mana_actuel = $int_mana;
    }

    public function get_mana_actuel() {
        return $this->int_mana_actuel;
    }
}