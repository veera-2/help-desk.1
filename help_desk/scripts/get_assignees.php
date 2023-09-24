<?php
include 'class_auto_loader.php';

$controler = new Controler();

if(!empty($_POST["department_id"])){

    $department_id = $_POST["department_id"];
    $result = $controler->assignees($department_id);

    echo json_encode($result);

}else {
    echo '{"response":false}';
}