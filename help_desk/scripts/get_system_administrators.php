<?php

include 'class_auto_loader.php';

$controler = new Controler();

if (!empty($_POST["id"])) {

    $user = $controler->system_admin($_POST["id"]);

    echo json_encode($user);
    
}else {

    $users = $controler->system_admins();

    echo json_encode($users);
}