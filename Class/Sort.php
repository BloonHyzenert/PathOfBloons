<?php

class Sort implements \JsonSerializable {

    protected $str_nom;
    protected $int_degat;
    protected $str_effet;
    protected $str_image;
    
    public function __construct($str_nom, $int_degat, $str_effet, $str_image) {
        $this->str_nom = $str_nom;
        $this->int_degat = $int_degat;
        $this->str_effet = $str_effet;
        $this->str_image = $str_image;
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

}