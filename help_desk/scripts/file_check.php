<?php

if (isset($_FILES["ticket_file"])) {  

    $res = array(
        "feedback" => true
    );
    
    echo json_encode($res);

    exit();

}else{

    $res = array(
        "feedback" => false
    );
    
    echo json_encode($res);

}
?>