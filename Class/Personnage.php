<?php


abstract class Personnage implements \JsonSerializable {

  protected $str_nom;
  protected $str_image;
  protected $int_pv;
  protected $int_pv_actuel;
  protected $int_attaque;
  protected $int_defense;
  protected $int_esquive;
  protected $int_critique;
 
  final public function jsonSerialize() {
    return get_object_vars($this);
  }
 
  public function get_nom() {
    return $this->str_nom;
  }

  public function get_pv() {
    return $this->int_pv;
  }

  public function get_pv_actuel() {
    return $this->int_pv_actuel;
  }

  public function get_attaque() {
    return $this->int_attaque;
  }
  public function get_defense() {
    return $this->int_defense;
  }
  public function get_esquive() {
    return $this->int_esquive;
  }
  public function get_critique() {
    return $this->int_critique;
  }

  public function get_image() {
    return $this->str_image;
  }
  
  public function set_attaque($int_attaque) {
    $this->int_attaque = $int_attaque;
  }

  public function set_pv($int_pv) {
    $this->$int_pv = $int_pv;
  }

  public function set_pv_actuel($int_pv_actuel) {
    $this->$int_pv_actuel = $int_pv_actuel;
  }

}
