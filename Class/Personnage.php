<?php


abstract class Personnage {
  protected $str_nom;
  protected $int_pv;
  protected $int_attaque;
  public function fct_hit($int_damage){
    $this->int_pv -= $int_damage;
    echo 'Aïe ! Je me sens faible, j\'ai '.$this->int_pv.' PV';
  }
  public function fct_heal($int_heal){
    $this->int_pv += $int_heal;
    echo 'Je me sens mieux, j\'ai '.$this->int_pv.' PV';
  }
}
