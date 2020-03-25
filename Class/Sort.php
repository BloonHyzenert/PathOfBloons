<?php

class Sort {

    protected $str_nom;
    protected $int_degat;
    protected $str_effet;
    
    public function __construct($str_nom, $int_degat, $str_effet) {
        $this->str_nom = $str_nom;
        $this->int_degat = $int_degat;
        $this->str_effet = $str_effet;
    }

    public function get_nom() {
        return $this->str_nom;
    }
}