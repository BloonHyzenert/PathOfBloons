<?php 

if(!isset($_SESSION['hero'])) {
    session_start();
}

if(isset($_POST['niveau']) && $_POST['niveau'] == 0) {

    //Instanciation des new objects
    //$_SESSION['hero'] = new guerrier();
    echo json_encode($arr_retour);
}
