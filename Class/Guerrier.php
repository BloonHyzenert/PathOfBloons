<?php

require_once 'Hero.php';

class Guerrier extends Hero {

    protected $int_rage;

    public function __construct($int_pv = 200, $int_pv_actuel = 200, $int_attaque = 25, $int_experience = 0, $int_niveau = 1, $int_rage = 0, $int_defense = 10, $int_cd_done = 1, $int_cd_done_2 = 4, $int_esquive = 10, $int_critique = 20) {
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

        $this->learn_sort("Justice", 1.2, "Inflige des dégats à l'ennemi et augmente votre rage de 25 points", "./ressources/justice.png");
        $this->learn_sort("Taillade", 1.45, "Inflige d'important à l'ennemi, ignore 50% de l'armure et augmente votre rage de 50 points", "./ressources/taillade.png", 1, $int_cd_done);

        if($this->int_niveau == 1) {
            $this->learn_sort("Dernier Souffle", 0, "Tombe a 1 HP, mais deviens immortel & augmente le taux critique à 100% pendant 2 tours, et régénère 75% des dégâts infligés !", "./ressources/souffle.png", 4, $int_cd_done_2);
        }
    }

    public static function withArray($arr_data) {     
        $obj_hero = new self($arr_data['int_pv'], $arr_data['int_pv_actuel'], $arr_data['int_attaque'], $arr_data['int_experience'], $arr_data['int_niveau'], $arr_data['int_rage'], $arr_data['int_defense'], $arr_data['arr_sorts'][1]['int_cd_done'], $arr_data['arr_sorts'][2]['int_cd_done']);
        return $obj_hero;
    }
 
    public function attaquer($obj_monstre, $id_sort) {

        $int_random = random_int(0, 100);
        if($int_random < $this->get_critique()) { // Gestion du critique 
            
            if($id_sort == 0) { // Sort 1 
                $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cd_done() + 1);
                if($this->get_sorts()[1]->get_cd_done() > $this->get_sorts()[1]->get_cooldown()) {
                    $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cooldown());
                }

                $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cd_done() + 1);
                if($this->get_sorts()[2]->get_cd_done() > $this->get_sorts()[2]->get_cooldown()) {
                    $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cooldown());
                }

                $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense()) * 2;
                $this->set_rage($this->get_rage() + 25);
            } else if($id_sort == 1) { // Sort 2
                $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cd_done() + 1);
                if($this->get_sorts()[2]->get_cd_done() > $this->get_sorts()[2]->get_cooldown()) {
                    $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cooldown());
                }

                if($this->get_sorts()[$id_sort]->get_cd_done() == $this->get_sorts()[$id_sort]->get_cooldown()) {
                    $this->get_sorts()[$id_sort]->set_cd_done(0);
                    $int_degat = ($this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense() * 0.5) * 2;
                    $this->set_rage($this->get_rage() + 50);
                } else {
                    return ["error" => "Le sort n'est pas encore prêt !"];
                }

            } else if($id_sort == 2) { // Sort 3
                $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cd_done() + 1);
                if($this->get_sorts()[1]->get_cd_done() > $this->get_sorts()[1]->get_cooldown()) {
                    $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cooldown());
                }

                if($this->get_sorts()[$id_sort]->get_cd_done() == $this->get_sorts()[$id_sort]->get_cooldown()) {
                    $this->get_sorts()[$id_sort]->set_cd_done(0);
                    $int_degat = 0;
                } else {
                    return ["error" => "Le sort n'est pas encore prêt !"];
                }
                $this->set_pv_actuel(1);
                $this->set_critique(100);
            }
        } else {
            if($id_sort == 0) {
                $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cd_done() + 1);
                if($this->get_sorts()[1]->get_cd_done() > $this->get_sorts()[1]->get_cooldown()) {
                    $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cooldown());
                }

                $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cd_done() + 1);
                if($this->get_sorts()[2]->get_cd_done() > $this->get_sorts()[2]->get_cooldown()) {
                    $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cooldown());
                }

                $int_degat = $this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense();
                $this->set_rage($this->get_rage() + 25);

            } else if($id_sort == 1) { // Sort 2
                $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cd_done() + 1);
                if($this->get_sorts()[2]->get_cd_done() > $this->get_sorts()[2]->get_cooldown()) {
                    $this->get_sorts()[2]->set_cd_done($this->get_sorts()[2]->get_cooldown());
                }

                if($this->get_sorts()[$id_sort]->get_cd_done() == $this->get_sorts()[$id_sort]->get_cooldown()) {
                    $this->get_sorts()[$id_sort]->set_cd_done(0);
                    $int_degat = $this->get_attaque() * $this->get_sort_degat($id_sort) - $obj_monstre->get_defense() * 0.5;
                    $this->set_rage($this->get_rage() + 50);
                } else {
                    return ["error" => "Le sort n'est pas encore prêt !"];
                }
            } else if($id_sort == 2) { // Sort 3
                $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cd_done() + 1);
                if($this->get_sorts()[1]->get_cd_done() > $this->get_sorts()[1]->get_cooldown()) {
                    $this->get_sorts()[1]->set_cd_done($this->get_sorts()[1]->get_cooldown());
                }

                if($this->get_sorts()[$id_sort]->get_cd_done() == $this->get_sorts()[$id_sort]->get_cooldown()) {
                    $this->get_sorts()[$id_sort]->set_cd_done(0);
                    $int_degat = 0;
                } else {
                    return ["error" => "Le sort n'est pas encore prêt !"];
                }
                $this->set_pv_actuel(1);
                $this->set_critique(100);
            }
        }
       
        if($id_sort != 2) {
            // Gestion de la rage
            if($this->get_rage() >= 100) {
                $this->set_rage(0);
                $int_degat *= 3;
            }

            // Gestion de l'esquive
            $int_random = random_int(0, 100);
            if($int_random <= $obj_monstre->get_esquive()) {
                $int_degat = -1;
                return ["message" => $obj_monstre->get_nom() . " esquiver votre attaque !!"];
            }
        } else {
            if($this->get_sorts()[2]->get_cooldown() - $this->get_sorts()[2]->get_cd_done() > 1) {
                // On est en ulty              
                return ["message" => $obj_monstre->get_nom() . " a perdu " . $int_degat . " points de vie", "effet" => "Je suis immortel"];
            } else {
                // Fin de l'ulty, reset du tx crit normal
                $this->set_critique(20);
            }
        }

        if($int_degat > 0) {
            if($obj_monstre->get_pv_actuel() - $int_degat < 0) {
                $obj_monstre->set_pv_actuel(0);    
            } else {
                $obj_monstre->set_pv_actuel(round($obj_monstre->get_pv_actuel() - $int_degat, 0));
            }

            if($this->get_sorts()[2]->get_cooldown() - $this->get_sorts()[2]->get_cd_done() > 1) {
                $this->set_pv_actuel($this->get_pv_actuel() + $int_degat * 0.75);
                if($this->get_pv_actuel() > $this->get_pv()) {
                    $this->set_pv_actuel($this->get_pv());
                }
            }

        } else if ($int_degat != -1) {
            $int_degat = 0;
            return ["message" => "Votre attaque n'est pas assez efficace"];
        } 

        if($this->get_sorts()[2]->get_cooldown() - $this->get_sorts()[2]->get_cd_done() > 1) {
            return ["message" => $obj_monstre->get_nom() . " a perdu " . $int_degat . " points de vie", "effet" => "Je suis immortel"];
        } else {
            return ["message" => $obj_monstre->get_nom() . " a perdu " . $int_degat . " points de vie"];
        }

    }
    
    public function set_rage($int_rage) {
        $this->int_rage = $int_rage;
    }

    public function get_rage() {
        return $this->int_rage;
    }
}