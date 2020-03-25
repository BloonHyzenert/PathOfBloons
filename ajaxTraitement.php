<?php 

require_once 'Class/Guerrier.php';
require_once 'Class/Mage.php';
require_once 'Class/Pretre.php';
require_once 'Class/Monstre.php';
require_once 'Class/Sort.php';

$arr_monstre = [];
$arr_monstre[] = new Monstre('Globloon', 50, 5, 0, 40, 10, 'gobelin.jpg');
$arr_monstre[] = new Monstre('Dragloon', 50, 5, 0, 40, 10, 'dragon.jpg');
$arr_monstre[] = new Monstre('Troloon', 50, 5, 0, 40, 10, 'troll.jpg');
$arr_monstre[] = new Monstre('Slimoon', 50, 5, 0, 40, 10, 'slime.jpg');
$arr_monstre[] = new Monstre('Orcloon', 50, 5, 0, 40, 10, 'orc.jpg');
$arr_monstre[] = new Monstre('Lichloon', 50, 5, 0, 40, 10, 'liche.jpg');

if(isset($_POST['niveau']) && $_POST['niveau'] == 0) {

    //Création du personnage et des monstres
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
    $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'mode' => 'choix_chemin', 'niveau' => $_POST['niveau'] + 1, 'monstre1' => 'gobelin.jpg', 'monstre2' => 'dragon.jpg'];
    echo json_encode($arr_retour);
}

if(isset($_POST['niveau']) && $_POST['niveau'] > 0) { 
   
    $arr_retour = [];

    if($_POST['hero']['str_nom'] === 'Guerrier') {
        $obj_hero = Guerrier::withArray($_POST['hero']);
    } else if($_POST['hero']['str_nom'] === 'Mage') {
        $obj_hero = Mage::withArray($_POST['hero']);
    } else if($_POST['hero']['str_nom'] === 'Pretre') {
        $obj_hero = Pretre::withArray($_POST['hero']);
    }

    if(!isset($_POST['monstre'])) {
        
        switch($_POST['choix']) {
            case '0':
                // Evenement
                $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'mode' => 'choix_chemin', 'niveau' => $_POST['niveau'] + 1];
            break;
            case '1':
                // Monstre 1
                $obj_monstre = $arr_monstre[0];
                $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'monstre' => $obj_monstre->jsonSerialize(), 'mode' => 'combat', 'niveau' => $_POST['niveau'] + 1];
            break;
            case '2':
                // Monstre 2
                $obj_monstre = $arr_monstre[1];
                $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'monstre' => $obj_monstre->jsonSerialize(), 'mode' => 'combat', 'niveau' => $_POST['niveau'] + 1];
            break;
        }    

    } else {
        $obj_monstre = Monstre::withArray($_POST['monstre']);

        //Combat 

        //si pv = 0 monstre = choix chemin + niveau++. Si pv = 0 hero, game over sinon mode = combat
        $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'monstre' => $obj_monstre->jsonSerialize(), 'mode' => 'combat', 'niveau' => $_POST['niveau']];
    }

    echo json_encode($arr_retour);
}
