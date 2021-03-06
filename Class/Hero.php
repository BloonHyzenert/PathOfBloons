<?php

require_once 'Personnage.php';
require_once 'Sort.php';

abstract class Hero extends Personnage {

  protected $int_experience;
  protected $int_niveau;
  protected $arr_sorts;
  
  public function learn_sort($str_nom, $int_degat, $str_effet, $str_image, $int_cooldown = 0, $int_cd_done = 0) {
    $this->arr_sorts[] = new Sort($str_nom, $int_degat, $str_effet, $str_image, $int_cooldown, $int_cd_done);
  }

  public function nouveau_niveau() {

    $this->set_niveau($this->get_niveau() + 1);
    $this->set_experience($this->get_experience() - 100);

    if($this instanceof Guerrier) {
      $this->set_pv($this->get_pv() + 65);
      $this->set_pv_actuel($this->get_pv_actuel() + 65);
      $this->set_attaque($this->get_attaque() + 5);
      $this->set_defense($this->get_defense() + 7);

    } else if($this instanceof Mage) {
      $this->set_pv($this->get_pv() + 50);
      $this->set_pv_actuel($this->get_pv_actuel() + 50);
      $this->set_attaque($this->get_attaque() + 6);
      $this->set_defense($this->get_defense() + 2);
      $this->set_critique($this->get_critique() + 2);

    } else if ($this instanceof Pretre) {
      $this->set_pv($this->get_pv() + 35);
      $this->set_pv_actuel($this->get_pv_actuel() + 35);
      $this->set_attaque($this->get_attaque() + 10);
      $this->set_defense($this->get_defense() + 2);
    }
  }

  public function gagner_experience($obj_hero, $obj_monstre) {
    $obj_hero->set_experience($obj_hero->get_experience() + $obj_monstre->get_experience());
    if($obj_hero->get_experience() >= 100) {
        $obj_hero->nouveau_niveau();
    }
  }

  public function get_sorts() {
    return $this->arr_sorts;
  }

  public function get_sort_degat($id_sort) {
    return $this->arr_sorts[$id_sort]->get_degat();
  }
  
  public function get_experience() {
    return $this->int_experience;
  }
  
  public function set_experience($int_experience) {
    $this->int_experience = $int_experience;
  }

  public function get_niveau() {
    return $this->int_niveau;
  }

  public function set_niveau($int_niveau) {
    $this->int_niveau = $int_niveau;
  }
}
