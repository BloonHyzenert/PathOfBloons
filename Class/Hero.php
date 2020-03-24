<?php

require_once 'Personnage.php';

class Hero extends Personnage implements \JsonSerializable {

  protected $int_experience;
  protected $arr_sorts;

  public function __construct($str_nom, $int_pv, $int_attaque) {
    $this->str_nom = $str_nom;
    $this->int_pv = $int_pv;
    $this->int_attaque = $int_attaque;
    $this->int_experience = 0;
    $this->arr_sorts = [];
  }

  public function jsonSerialize() {
    return get_object_vars($this);
  }
  
  public function learn_sort($sort){
    $this->sorts[] = $sort;
    $this->arr_sorts = [];
  }
  
  public function get_sorts(){
    return $this->arr_sorts;
  }
  
  public function get_experience(){
    return $this->int_experience;
  }
}
