<?php

require_once 'Personnage.php';

class Monstre extends Personnage{

  public function __construct($str_nom, $int_pv, $int_attaque) {
    $this->str_nom = $str_nom;
    $this->int_pv = $int_pv;
    $this->int_attaque = $int_attaque;
    echo 'JE SUIS UN '.$this->str_nom;
  }
}
