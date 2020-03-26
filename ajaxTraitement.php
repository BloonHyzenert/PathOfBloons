<?php 

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'Class/Guerrier.php';
require_once 'Class/Mage.php';
require_once 'Class/Pretre.php';
require_once 'Class/Monstre.php';
require_once 'Class/Sort.php';

$arr_monstre = [
    0 => [
        'str_nom' => 'Globloon',
        'str_image' => 'gobelin.jpg',
        'int_pv' => 60, 
        'int_pv_actuel' => 60, 
        'int_attaque' => 20, 
        'int_defense' => 0, 
        'int_esquive' => 40, 
        'int_critique' => 10
    ],

    1 => [
        'str_nom' => 'Dragloon',
        'str_image' => 'dragon.jpg',
        'int_pv' => 200, 
        'int_pv_actuel' => 200, 
        'int_attaque' => 50, 
        'int_defense' => 30, 
        'int_esquive' => 10, 
        'int_critique' => 50
    ],

    2 => [
        'str_nom' => 'Troloon',
        'str_image' => 'troll.jpg',
        'int_pv' => 300, 
        'int_pv_actuel' => 300, 
        'int_attaque' => 30, 
        'int_defense' => 30, 
        'int_esquive' => 0, 
        'int_critique' => 0
    ],

    3 => [
        'str_nom' => 'Slimoon',
        'str_image' => 'slime.jpg',
        'int_pv' => 30, 
        'int_pv_actuel' => 30, 
        'int_attaque' => 15, 
        'int_defense' => 0, 
        'int_esquive' => 0, 
        'int_critique' => 10
    ],

    4 => [
        'str_nom' => 'Orcloon',
        'str_image' => 'orc.jpg',
        'int_pv' => 125, 
        'int_pv_actuel' => 125, 
        'int_attaque' => 25, 
        'int_defense' => 10, 
        'int_esquive' => 10, 
        'int_critique' => 10
    ],

    5 => [
        'str_nom' => 'Lichloon',
        'str_image' => 'liche.jpg',
        'int_pv' => 175, 
        'int_pv_actuel' => 175, 
        'int_attaque' => 45, 
        'int_defense' => 10, 
        'int_esquive' => 10, 
        'int_critique' => 10
    ],
];

if(isset($_POST['niveau']) && $_POST['niveau'] == 0 && !isset($_POST['hero'])) {

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

    foreach($obj_hero->get_sorts() as $sort) {
        $sort->jsonSerialize();
    }

    $int_rand1 = random_int(0, count($arr_monstre) - 1);
    $int_rand2 = random_int(0, count($arr_monstre) - 1);

    $arr_retour = [
        'hero' => $obj_hero->jsonSerialize(), 
        'mode' => 'choix_chemin', 
        'm_id1' => $int_rand1, 
        'm_id2'=> $int_rand2, 
        'monstre_1' => new Monstre($arr_monstre[$int_rand1]), 
        'monstre_2' => new Monstre($arr_monstre[$int_rand2]), 
        'niveau' => $_POST['niveau']
    ];

    echo json_encode($arr_retour);
}

if(isset($_POST['hero'])) { 

    $arr_retour = [];
    if($_POST['hero']['str_nom'] === 'Guerrier') { // Constructeurs surchargé
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

                // Nouveau choix de monstre
                $int_rand1 = random_int(0, count($arr_monstre) - 1);
                $int_rand2 = random_int(0, count($arr_monstre) - 1);
            
                $arr_retour = [
                    'hero' => $obj_hero->jsonSerialize(), 
                    'mode' => 'choix_chemin', 
                    'm_id1' => $int_rand1, 
                    'm_id2'=> $int_rand2, 
                    'monstre_1' => new Monstre($arr_monstre[$int_rand1]), 
                    'monstre_2' => new Monstre($arr_monstre[$int_rand2]), 
                    'niveau' => $_POST['niveau'] + 1
                ];
            break;
            case '1':
                // Choix monstre 1
                $obj_monstre = new Monstre($arr_monstre[$_POST['id_monstre']], $_POST['niveau']);
                $arr_retour = [
                    'hero' => $obj_hero->jsonSerialize(), 
                    'monstre' => $obj_monstre, 
                    'mode' => 'combat', 
                    'niveau' => $_POST['niveau'] + 1
                ];
            break;
            case '2':
                // Choix monstre 2
                $obj_monstre = new Monstre($arr_monstre[$_POST['id_monstre']], $_POST['niveau']);
                $arr_retour = [
                    'hero' => $obj_hero->jsonSerialize(), 
                    'monstre' => $obj_monstre, 
                    'mode' => 'combat', 
                    'niveau' => $_POST['niveau'] + 1
                ];
            break;
        }    

    } else {
        $obj_monstre = Monstre::withArray($_POST['monstre']);

        //Combat 
        $obj_hero->attaquer($obj_monstre, $_POST['choix']);

        if($obj_monstre->get_pv_actuel() == 0) {

            $obj_hero->set_experience($obj_hero->get_experience() + 100);
            if($obj_hero->get_experience() >= 100) {
                $obj_hero->nouveau_niveau();
            }

            // Nouveau choix monstres
            $int_rand1 = random_int(0, count($arr_monstre) - 1);
            $int_rand2 = random_int(0, count($arr_monstre) - 1);

            $arr_retour = [
                'hero' => $obj_hero->jsonSerialize(), 
                'mode' => 'choix_chemin', 
                'm_id1' => $int_rand1, 
                'm_id2'=> $int_rand2, 
                'monstre_1' => new Monstre($arr_monstre[$int_rand1]), 
                'monstre_2' => new Monstre($arr_monstre[$int_rand2]),
                'niveau' => $_POST['niveau']
            ];
        } else {

            $obj_monstre->attaquer($obj_hero);

            if($obj_hero->get_pv_actuel() == 0) {
                //Choix du perso
                $arr_retour = ['mode' => 'choix_hero', 'niveau' => 0];
            } else {
                $arr_retour = ['hero' => $obj_hero->jsonSerialize(), 'monstre' => $obj_monstre, 'mode' => 'combat', 'niveau' => $_POST['niveau']];
            }
        }
    }
    echo json_encode($arr_retour);
}
