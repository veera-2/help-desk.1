<?php
include 'class_auto_loader.php';

$controler = new Controler();

if(!empty($_POST["code"]) && !empty($_POST["assignee_id"])){

    $code = $_POST["code"];
    $assignee_id = $_POST["assignee_id"];
    
    $controler->assign($assignee_id, $code);

}else {
    echo '{"response":false}';
}