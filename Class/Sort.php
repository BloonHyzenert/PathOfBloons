<?php

class Sort implements \JsonSerializable {

    protected $str_nom;
    protected $int_degat;
    protected $str_effet;
    protected $int_cooldown;
    protected $int_cd_done;
    protected $str_image;
    
    public function __construct($str_nom, $int_degat, $str_effet, $str_image, $int_cooldown = 0, $int_cd_done = 0) {
        $this->str_nom = $str_nom;
        $this->int_degat = $int_degat;
        $this->str_effet = $str_effet;
        $this->str_image = $str_image;
        $this->int_cooldown = $int_cooldown;
        $this->int_cd_done = $int_cd_done;
    }

    public function get_nom() {
        return $this->str_nom;
    }

    public function get_degat() {
        return $this->int_degat;
    }

    final public function jsonSerialize() {
        return get_object_vars($this);
    }

    public function get_cooldown() {
        return $this->int_cooldown;
    }

    public function set_cd_done($int_cd_done) {
        return $this->int_cd_done = $int_cd_done;
    }

    public function get_cd_done() {
        return $this->int_cd_done;
    }
}