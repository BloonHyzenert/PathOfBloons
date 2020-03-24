<?php

require_once 'Personnage.php';

class Hero extends Personnage{

  protected $int_experience;
  public $sorts = [];

  public function __construct($str_nom, $int_pv, $int_attaque) {
    $this->str_nom = $str_nom;
    $this->int_pv = $int_pv;
    $this->int_attaque = $int_attaque;
    $this->int_experience = 0;
    echo 'JE SUIS UN '.$this->str_nom;
  }

  public function learn_sort($sort){
    $this->sorts[] = $sort;
    echo 'Cool! J\'ai appris '.$sort->get_nom() ;
  }
}
