<?php

require_once 'Personnage.php';

class Monstre extends Personnage implements \JsonSerializable {

  public function __construct($str_nom, $int_pv, $int_pv_actuel, $int_attaque, $int_defense, $int_esquive, $int_critique, $str_image) {
    $this->str_nom = $str_nom;
    $this->int_pv = $int_pv;
    $this->int_pv_actuel = $int_pv_actuel;
    $this->int_attaque = $int_attaque;
    $this->int_defense = $int_defense;
    $this->int_esquive = $int_esquive;
    $this->int_critique = $int_critique;
    $this->str_image = $str_image;

  }

  public static function withArray($arr_data) {
    $obj_hero = new self($arr_data['str_nom'], $arr_data['int_pv'], $arr_data['int_pv_actuel'], $arr_data['int_attaque'], $arr_data['int_defense'], $arr_data['int_esquive'], $arr_data['int_critique'], $arr_data['str_image']);
    $obj_hero->set_pv($arr_data['int_pv']);
    $obj_hero->set_attaque($arr_data['int_attaque']);
    return $obj_hero;
}

}
