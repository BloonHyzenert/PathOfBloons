<?php

require_once 'Personnage.php';

class Monstre extends Personnage implements \JsonSerializable {

  public function __construct($arr_data, $int_niveau = 1) {
    $this->str_nom = $arr_data['str_nom'];
    $this->str_image = $arr_data['str_image'];

    $this->int_pv = $arr_data['int_pv'] + 10 * $int_niveau;
    $this->int_pv_actuel = $arr_data['int_pv_actuel'] + 10 * $int_niveau;
    $this->int_attaque = $arr_data['int_attaque'] + 3 * $int_niveau;
    $this->int_defense = $arr_data['int_defense'] + 2 * $int_niveau;
    $this->int_esquive = $arr_data['int_esquive'];
    $this->int_critique = $arr_data['int_critique'];
    $this->int_experience = $arr_data['int_experience'];
  }

  public static function withArray($arr_data) {
    $obj_hero = new self($arr_data, $int_niveau = 0);
    return $obj_hero;
  }

  public function attaquer($obj_hero) {

    $int_random = random_int(0, 100);
    if($int_random < $this->get_critique()) { // Gestion du critique 
      $int_degat = ($this->get_attaque() - $obj_hero->get_defense()) * 2;
    } else {
      $int_degat = $this->get_attaque() - $obj_hero->get_defense();
    }

    //Gestion de l'esquive
    $int_random = random_int(0, 100);
    if($int_random < $obj_hero->get_esquive()) {
        $int_degat = 0;
        return ["message" => "Le " . $obj_hero->get_nom() . " esquiver votre attaque !!"];
    }

    if($int_degat > 0) {
      if($obj_hero->get_pv_actuel() - $int_degat < 0) {
          $obj_hero->set_pv_actuel(0);    
      } else {
          $obj_hero->set_pv_actuel(round($obj_hero->get_pv_actuel() - $int_degat, 0));
      }
      return "Le " . $obj_hero->get_nom() . " a perdu " . $int_degat . " points de vie";
    }
  } 

  public function get_experience() {
    return $this->int_experience;
  }
}
