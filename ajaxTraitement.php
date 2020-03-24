<?php 

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
            $obj_hero = new Bougnoule();
        break;
    }

    //$_SESSION['hero'] = $obj_hero;
    $arr_retour = ['personnage' => $obj_hero];
    echo json_encode($arr_retour);
}
