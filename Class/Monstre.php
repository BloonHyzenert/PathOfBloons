<?php

require_once 'Personnage.php';

class Monstre extends Personnage implements \JsonSerializable {

  public function __construct($str_nom, $int_pv, $int_attaque, $int_defense, $int_esquive, $int_critique) {
    $this->str_nom = $str_nom;
    $this->int_pv = $int_pv;
    $this->int_attaque = $int_attaque;
    $this->int_defense = $int_defense;
    $this->int_esquive = $int_esquive;
    $this->int_critique = $int_critique;

  }
}
