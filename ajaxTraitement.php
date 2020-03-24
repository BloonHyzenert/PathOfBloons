<?php 
require_once 'Class/Guerrier.php';
require_once 'Class/Mage.php';
require_once 'Class/Pretre.php';
require_once 'Class/Monstre.php';
require_once 'Class/Sort.php';
// $hero = new Guerrier();
// $monstre = new Monstre("DRAGON", 40, 10);
// $coup_tranchant = new Sort("Coup Tranchant", function($hero,$monstre){$monstre->fct_hit(5);});
// $hero->learn_sort($coup_tranchant);
// $monstre->fct_hit(20);
// $monstre->fct_heal(10);
if(!isset($_SESSION['hero'])) {
    session_start();
}

if(isset($_POST['niveau']) && $_POST['niveau'] == 0) {

    //Instanciation des new objects
    switch($_POST['choix']) {
        case '0':
            $obj_hero = new Guerrier();
        break;
        case '1':
            $obj_hero = new Mage();
        break;
        case '2':
            $obj_hero = new Pretre();
        break;
    }

    //$_SESSION['hero'] = $obj_hero;
    $arr_retour = ['personnage' => $obj_hero];
    echo json_encode($arr_retour);
}
