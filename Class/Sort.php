<?php

class Sort {

    private $str_nom;
    
    public function __construct($str_nom, $sort) {
        $this->str_nom = $str_nom;
        $this->sort = $sort;
    }

    public function get_nom(){
        return $this->str_nom;
    }
    public $sort;

}