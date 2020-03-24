<?php

include 'Personnage.php';
include 'Sort.php';

class Colosse extends Personnage {

    private $passif;

    public function __construct() {
        $this->str_class = "JE SUIS UN COLOSSE";
        echo $this->str_class;
    }
}