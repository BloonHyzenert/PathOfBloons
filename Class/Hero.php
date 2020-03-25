<?php

require_once 'Personnage.php';
require_once 'Sort.php';

abstract class Hero extends Personnage {

  protected $int_experience;
  protected $int_niveau;
  protected $arr_sorts;
  
  public function learn_sort($str_nom, $int_degat, $str_effet) {
    $this->arr_sorts[] = new Sort($str_nom, $int_degat, $str_effet);
  }
  
  public function get_sorts() {
    return $this->arr_sorts;
  }
  
  public function get_experience() {
    return $this->int_experience;
  }
}
