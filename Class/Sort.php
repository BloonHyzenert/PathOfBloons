<?php

class Sort {

    private $str_nom;
    private $str_type;
    
    public function __construct($str_nom, $str_type) {
        $this->str_nom = $str_nom;
        $this->str_type = $str_type;
    }

    public function sort() {
        echo "Je lance un sort";
    }
}