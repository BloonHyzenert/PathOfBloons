<?php 
require_once 'Class/Guerrier.php';
require_once 'Class/Monstre.php';
require_once 'Class/Sort.php';
$hero = new Guerrier();
$monstre = new Monstre("DRAGON", 40, 10);
$coup_tranchant = new Sort("Coup Tranchant", function($hero,$monstre){$monstre->fct_hit(5);});
$hero->learn_sort($coup_tranchant);
$monstre->fct_hit(20);
$monstre->fct_heal(10);