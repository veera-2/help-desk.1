<?php

include 'class_auto_loader.php';

$controler = new Controler();

if (!empty($_POST["id"])) {

    $user = $controler->system_users($_POST["id"]);

    echo json_encode($user);
    
}else {

    $users = $controler->system_users();

    echo json_encode($users);
}