<?php
include 'class_auto_loader.php';

$controler = new Controler();

if(!empty($_POST["id"]) && !empty($_POST["password"]) && !empty($_POST["confirm"])){

    $id = $_POST["id"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if ($password == $confirm) {
        $controler->change_password($id, $password);
    }

}else {
    echo '{"response":false}';
}