<?php 

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'Class/Guerrier.php';
require_once 'Class/Mage.php';
require_once 'Class/Pretre.php';
require_once 'Class/Monstre.php';
require_once 'Class/Sort.php';

$arr_monstre_superieur = [
    0 => [
        'str_nom' => 'Dragloon',
        'str_image' => 'dragon.jpg',
        'int_pv' => 200, 
        'int_pv_actuel' => 200, 
        'int_attaque' => 50, 
        'int_defense' => 30, 
        'int_esquive' => 10, 
        'int_critique' => 50,
        'int_experience' => 80
    ],

    1 => [
        'str_nom' => 'Troloon',
        'str_image' => 'troll.jpg',
        'int_pv' => 300, 
        'int_pv_actuel' => 300, 
        'int_attaque' => 30, 
        'int_defense' => 30, 
        'int_esquive' => 0, 
        'int_critique' => 10,
        'int_experience' => 60
    ],

    2 => [
        'str_nom' => 'Lichloon',
        'str_image' => 'liche.jpg',
        'int_pv' => 175, 
        'int_pv_actuel' => 175, 
        'int_attaque' => 45, 
        'int_defense' => 10, 
        'int_esquive' => 10, 
        'int_critique' => 10,
        'int_experience' => 65
    ],

    3 => [
        'str_nom' => 'Demnoon',
        'str_image' => 'demon.jpg',
        'int_pv' => 350, 
        'int_pv_actuel' => 350, 
        'int_attaque' => 60, 
        'int_defense' => 20, 
        'int_esquive' => 5, 
        'int_critique' => 20,
        'int_experience' => 75
    ],

    4 => [
        'str_nom' => 'Ogroon',
        'str_image' => 'ogre.jpg',
        'int_pv' => 355, 
        'int_pv_actuel' => 355, 
        'int_attaque' => 15, 
        'int_defense' => 35, 
        'int_esquive' => 0, 
        'int_critique' => 0,
        'int_experience' => 45
    ],
];

$arr_monstre_inferieur = [
    0 => [
        'str_nom' => 'Globloon',
        'str_image' => 'gobelin.jpg',
        'int_pv' => 50, 
        'int_pv_actuel' => 50, 
        'int_attaque' => 15, 
        'int_defense' => 3, 
        'int_esquive' => 40, 
        'int_critique' => 10,
        'int_experience' => 25
    ],

    1 => [
        'str_nom' => 'Slimoon',
        'str_image' => 'slime.jpg',
        'int_pv' => 80, 
        'int_pv_actuel' => 80, 
        'int_attaque' => 20, 
        'int_defense' => 5, 
        'int_esquive' => 0, 
        'int_critique' => 20,
        'int_experience' => 30
    ],

    2 => [
        'str_nom' => 'Orcloon',
        'str_image' => 'orc.jpg',
        'int_pv' => 125, 
        'int_pv_actuel' => 125, 
        'int_attaque' => 25, 
        'int_defense' => 10, 
        'int_esquive' => 10, 
        'int_critique' => 10,
        'int_experience' => 35
    ],

    3 => [
        'str_nom' => 'Squelettoon',
        'str_image' => 'squelette.jpg',
        'int_pv' => 100, 
        'int_pv_actuel' => 100, 
        'int_attaque' => 20, 
        'int_defense' => 5, 
        'int_esquive' => 5, 
        'int_critique' => 15,
        'int_experience' => 40
    ],

    4 => [
        'str_nom' => 'Spectroon',
        'str_image' => 'spectre.jpg',
        'int_pv' => 10, 
        'int_pv_actuel' => 10, 
        'int_attaque' => 25, 
        'int_defense' => 0, 
        'int_esquive' => 75, 
        'int_critique' => 15,
        'int_experience' => 30
    ],

    5 => [
        'str_nom' => 'Chienoon',
        'str_image' => 'chien.jpg',
        'int_pv' => 150, 
        'int_pv_actuel' => 150, 
        'int_attaque' => 25, 
        'int_defense' => 20, 
        'int_esquive' => 10, 
        'int_critique' => 10,
        'int_experience' => 40
    ],
];

if(isset($_POST['niveau']) && $_POST['niveau'] == 0 && !isset($_POST['hero'])) {

    $str_message = '';
    //Création du personnage et des monstres
    switch($_POST['choix']) {
        case '0':
            $obj_hero = new Guerrier();
            $str_message = "Pour la gloire, et l'honneur !";
        break;
        case '1':
            $obj_hero = new Mage();
            $str_message = "La magie prévaudra !";
        break;
        case '2':
            $obj_hero = new Pretre();
            $str_message = "Purifions ces infâmes créatures !";
        break;
    }

    foreach($obj_hero->get_sorts() as $sort) {
        $sort->jsonSerialize();
    }

    $int_rand1 = random_int(0, count($arr_monstre_inferieur) - 1);
    $int_rand2 = random_int(0, count($arr_monstre_superieur) - 1);

    $arr_retour = [
        'hero' => $obj_hero->jsonSerialize(), 
        'mode' => 'choix_chemin', 
        'm_id1' => $int_rand1, 
        'm_id2'=> $int_rand2, 
        'monstre_1' => new Monstre($arr_monstre_inferieur[$int_rand1]), 
        'monstre_2' => new Monstre($arr_monstre_superieur[$int_rand2]), 
        'niveau' => $_POST['niveau'],
        'message' => $str_message
    ];

    echo json_encode($arr_retour);
}

if(isset($_POST['hero'])) { 

    $arr_retour = [];
    $message_combat = ['message' => ''];
    $arr_message = ['Dans le carnage, je fleuris, comme une fleur à l\'aube', 'La Puissance est mère de la guerre !', "Je détruirai tout, même l'espoir."];
    
    if($_POST['hero']['str_nom'] === 'Guerrier') { // Constructeurs surchargé
        $obj_hero = Guerrier::withArray($_POST['hero']);
    } else if($_POST['hero']['str_nom'] === 'Mage') {
        $obj_hero = Mage::withArray($_POST['hero']);
    } else if($_POST['hero']['str_nom'] === 'Pretre') {
        $obj_hero = Pretre::withArray($_POST['hero']);
    }

    if(!isset($_POST['monstre'])) {
        
        $int_random_message = random_int(0, count($arr_message) - 1);

        switch($_POST['choix']) {
            case '0':
                // Evenement
                $int_soin = $obj_hero->get_pv() * (random_int(25, 75) / 100);
                $obj_hero->set_pv_actuel($obj_hero->get_pv_actuel() + $int_soin); 

                if($obj_hero->get_pv_actuel() > $obj_hero->get_pv()) {
                    $int_soin -= $obj_hero->get_pv_actuel() - $obj_hero->get_pv();
                    $obj_hero->set_pv_actuel($obj_hero->get_pv());
                }
                // Nouveau choix de monstre
                $int_rand1 = random_int(0, count($arr_monstre_inferieur) - 1);
                $int_rand2 = random_int(0, count($arr_monstre_superieur) - 1);

                $arr_retour = [
                    'hero' => $obj_hero->jsonSerialize(), 
                    'mode' => 'choix_chemin', 
                    'm_id1' => $int_rand1, 
                    'm_id2'=> $int_rand2, 
                    'monstre_1' => new Monstre($arr_monstre_inferieur[$int_rand1]), 
                    'monstre_2' => new Monstre($arr_monstre_superieur[$int_rand2]), 
                    'niveau' => $_POST['niveau'] + 1,
                    'message' => "Vous vous êtes soigné de " . $int_soin . " points de vie"
                ];
            break;
            case '1':
                // Choix monstre 1
                $obj_monstre = new Monstre($arr_monstre_inferieur[$_POST['id_monstre']], $_POST['niveau']);
                $arr_retour = [
                    'hero' => $obj_hero->jsonSerialize(), 
                    'monstre' => $obj_monstre, 
                    'mode' => 'combat', 
                    'niveau' => $_POST['niveau'] + 1,
                    'message' => $arr_message[$int_random_message]
                ];
            break;
            case '2':
                // Choix monstre 2
                $obj_monstre = new Monstre($arr_monstre_superieur[$_POST['id_monstre']], $_POST['niveau']);
                $arr_retour = [
                    'hero' => $obj_hero->jsonSerialize(), 
                    'monstre' => $obj_monstre, 
                    'mode' => 'combat', 
                    'niveau' => $_POST['niveau'] + 1,
                    'message' => $arr_message[$int_random_message]
                ];
            break;
        }    

    } else {
        $obj_monstre = Monstre::withArray($_POST['monstre']);

        //Combat 
        $message_combat = $obj_hero->attaquer($obj_monstre, $_POST['choix']);

        if($obj_monstre->get_pv_actuel() == 0) {
            $obj_hero->gagner_experience($obj_hero, $obj_monstre);

            // Nouveau choix monstres
            $int_rand1 = random_int(0, count($arr_monstre_inferieur) - 1);
            $int_rand2 = random_int(0, count($arr_monstre_superieur) - 1);

            $arr_retour = [
                'hero' => $obj_hero->jsonSerialize(), 
                'mode' => 'choix_chemin', 
                'm_id1' => $int_rand1, 
                'm_id2'=> $int_rand2, 
                'monstre_1' => new Monstre($arr_monstre_inferieur[$int_rand1]), 
                'monstre_2' => new Monstre($arr_monstre_superieur[$int_rand2]),
                'niveau' => $_POST['niveau'],
                'message' => "Vous avez tué " . $obj_monstre->get_nom()
            ];
        } else {

            if(!isset($message_combat['error']) && !isset($message_combat['effet'])) {
                $obj_monstre->attaquer($obj_hero);
            }

            if(isset($message_combat['error'])) {
                $str_message = $message_combat['error'];
            } else if (isset($message_combat['effet'])) {
                $str_message = $message_combat['message'] . "<br>" . $message_combat['effet'];
            } else {
                $str_message = $message_combat['message']; 
            }

            if($obj_hero->get_pv_actuel() == 0) {
                //Choix du perso
                $arr_retour = [
                    'mode' => 'choix_hero', 
                    'niveau' => 0,
                    'message' => "Vous êtes mort !!"
                ];
            } else {
                $arr_retour = [
                    'hero' => $obj_hero->jsonSerialize(), 
                    'monstre' => $obj_monstre, 
                    'mode' => 'combat', 
                    'niveau' => $_POST['niveau'],
                    'message' => $str_message
                ];
            }
        }
    }
    echo json_encode($arr_retour);
}
