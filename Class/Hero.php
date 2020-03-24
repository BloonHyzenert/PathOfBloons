<?php

require_once 'Personnage.php';

abstract class Hero extends Personnage implements \JsonSerializable {

  protected $int_experience;
  protected $arr_sorts;
  
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
