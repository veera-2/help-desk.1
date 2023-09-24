<?php
include 'class_auto_loader.php';

$controler = new Controler();

if(!empty($_POST["code"])){

    $code = $_POST["code"];
    
    $controler->open($code);

}else {
    echo 'false';
}