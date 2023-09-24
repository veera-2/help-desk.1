<?php
include 'class_auto_loader.php';

if($_POST["check_username"]){

    $username = $_POST["check_username"];

    $controler = new Controler();

    $controler->check_username($username);

}else {
    echo '{"response":false}';
}