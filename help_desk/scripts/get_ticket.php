<?php

include 'class_auto_loader.php';

$controler = new Controler();

if (!empty($_POST["code"])) {

    $ticket = $controler->ticket($_POST["code"]);

    echo json_encode($ticket);
    
}else {

    $tickets = $controler->tickets();

    echo json_encode($tickets);
}