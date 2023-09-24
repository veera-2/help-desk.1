<?php

include 'class_auto_loader.php';

$controler = new Controler();

if (!empty($_POST["code"])) {

    $ticket = $controler->ticket($_POST["code"]);

    echo json_encode($ticket);
    
}elseif (!empty($_POST["id"])) {

    $ticket = $controler->user_tickets($_POST["id"]);

    echo json_encode($ticket);
    
} else {


    echo $_POST["id"];
}