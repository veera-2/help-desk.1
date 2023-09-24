<?php
include 'class_auto_loader.php';

$controler = new Controler();

if(!empty($_POST["id"])){

    $id = $_POST["id"];
    
    $controler->delete_user($id);

}else {
    echo 'faild';
}