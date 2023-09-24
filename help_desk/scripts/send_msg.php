<?php
include 'class_auto_loader.php';

$controler = new Controler();

if(!empty($_POST["code"]) && !empty($_POST["msg"])){

    $code = $_POST["code"];
    $msg = $_POST["msg"];
    $id = $_POST["id"];

    $controler->send_msg($code, $msg, $id);

}else {
    echo 'false';
}