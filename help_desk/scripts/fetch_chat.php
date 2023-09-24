<?php
include 'class_auto_loader.php';

$controler = new Controler();

if(!empty($_POST["code"])){

    $code = $_POST["code"];

    $msgs = $controler->fetch_msgs($code);

    echo json_encode($msgs);

}else {
    echo 'false';
}