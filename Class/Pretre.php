<?php

require_once 'Hero.php';

class Pretre extends Hero {
    
    protected $int_foi_actuel;
    protected $int_foi_max;

    public function __construct($int_pv = 175, $int_pv_actuel = 175, $int_attaque = 35, $int_experience = 0, $int_niveau = 1, $int_defense = 5, $int_foi_max = 50, $int_foi_actuel = 0) {
        $this->str_nom = "Pretre";
        $this->str_image = "pretre.jpg";
        $this->int_pv = $int_pv;
        $this->int_pv_actuel = $int_pv_actuel;
        $this->int_attaque = $int_attaque;
        $this->int_experience = $int_experience;
        $this->int_niveau = $int_niveau;
        $this->int_defense = $int_defense;
        $this->int_esquive = 20;
        $this->int_critique = 30;
        $this->int_foi_max = $int_foi_max;
        $this->int_foi_actuel = $int_foi_actuel;

        $this->learn_sort("Marteau spirituel", 1.2, "Inflige des dégats à l'ennemi et augmente votre foi de 25 points", "./ressources/marteau.png");
        $this->learn_sort("Bénédiction", 1.65, "Inflige des dégats modéré à l'ennemi, consomme 50 points de foi, restore 100% des dégats de base infligé en point de vie (hors coup critique)", "./ressources/benediction.png");
    }

    public static function withArray($arr_data) {
        $obj_hero = new self($arr_data['int_pv'], $arr_data['int_pv_actuel'], $arr_data['int_attaque'], $arr_data['int_experience'], $arr_data['int_niveau'], $arr_data['int_defense'], $arr_data['int_foi_max'], $arr_data['int_foi_actuel']);
        return $obj_hero;
    }

    public function attaquer($obj_monstre, $id_sort) {
        $bln_ok = true;
        $int_degat = 0;
        $str_effet = '';

        // Gestion de l'esquive
        $int_random = random_int(0, 100);
        if($int_random <= $obj_monstre->get_esquive()) {
            $int_degat = -1;

            if($id_sort == 1) {
                if ($this->get_foi_actuel() - 50 < 0)  {
                    $this->set_foi_actuel(0);    
                } else {
                    $this->set_foi_actuel($this->get_foi_actuel() - 50);
                }
            }
            return ["message" => "Le " . $obj_monstre->get_nom() . " esquiver votre attaque !!"];
        } else {
            if($id_sort == 0) {
                $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense());
                if ($this->get_foi_actuel() + 25 > 50)  {
                    $this->set_foi_actuel(50);    
                } else {
                    $this->set_foi_actuel($this->get_foi_actuel() + 25);
                }
            } else if($id_sort == 1) {
                if ($this->get_foi_actuel() < 50) {
                    $bln_ok = false;
                } else {
                    $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense());
                    if ($this->get_foi_actuel() - 50 < 0)  {
                        $this->set_foi_actuel(0);    
                    } else {
                        $this->set_foi_actuel($this->get_foi_actuel() - 50);
                    }
    
                    if($this->get_pv_actuel() + $int_degat > $this->get_pv()) {
                        $this->set_pv_actuel($this->get_pv());
                    } else {
                        $this->set_pv_actuel(round($this->get_pv_actuel() + $int_degat, 0));
                    }
    
                    $str_effet = "Vous vous êtes soigné de " . $int_degat;
                }
            }
        }

        if($bln_ok) {
            // Gestion des degats critique
            $int_random = random_int(0, 100);
            if($int_random < $this->get_critique()) {
                $int_degat *= 2;
            }

            if($int_degat > 0) {
                if($obj_monstre->get_pv_actuel() - $int_degat < 0) {
                    $obj_monstre->set_pv_actuel(0);    
                } else {
                    $obj_monstre->set_pv_actuel($obj_monstre->get_pv_actuel() - $int_degat);
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
            return ["error" => "Pas assez de foi pour lancer le sort"];
        }
    }

    public function set_foi_max($int_foi_max) {
        $this->int_foi_max = $int_foi_max;
    }

    public function get_foi_max() {
        return $this->int_foi_max;
    }

    public function set_foi_actuel($int_foi_actuel) {
        $this->int_foi_actuel = $int_foi_actuel;
    }

    public function get_foi_actuel() {
        return $this->int_foi_actuel;
    }
}