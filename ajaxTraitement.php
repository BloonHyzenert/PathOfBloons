<?php 

require_once 'Class/Guerrier.php';
require_once 'Class/Mage.php';
require_once 'Class/Pretre.php';
require_once 'Class/Monstre.php';
require_once 'Class/Sort.php';

if(isset($_POST['niveau']) && $_POST['niveau'] == 0) {

    //Création du personnage
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

    $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'mode' => 'choix_chemin'];
    echo json_encode($arr_retour);
}

if(isset($_POST['niveau']) && $_POST['niveau'] > 0) { 
   
    $arr_retour = [];
    $obj_hero = $_POST['hero'];

    if(!isset($_POST['monstre'])) {
        $obj_monstre = new Monstre(20, 3, 2);
        $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'monstre' => $obj_monstre->jsonSerialize(), 'mode' => 'combat'];
    } else {
        $obj_monstre = $_POST['monstre'];



        //si pv = 0 mostre = choix chemin. Si pv = 0 hero, game over sinon mode = combat
        $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'monstre' => $obj_monstre->jsonSerialize(), 'mode' => 'combat'];
    }

    echo json_encode($arr_retour);
}
