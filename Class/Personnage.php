<?php


abstract class Personnage {

  protected $str_nom;
  protected $int_pv;
  protected $int_attaque;
 
  final public function jsonSerialize() {
    return get_object_vars($this);
  }
  
  public function get_nom() {
    return $this->str_nom;
  }

  public function get_pv() {
    return $this->int_pv;
  }

  public function get_attaque() {
    return $this->int_attaque;
  }
  
  public function set_attaque($int_attaque) {
    $this->int_attaque = $int_attaque;
  }

  public function set_pv($int_pv) {
    $this->$int_pv = $int_pv;
  }
}
