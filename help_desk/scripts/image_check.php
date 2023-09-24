<?php
if (isset($_FILES["inf-img"])) {  
    $image_name = $_FILES["inf-img"]["tmp_name"];
    $img_details = getimagesize($image_name);
    $res = array(
        "width" => $img_details[0],
        "height" => $img_details[1],
        "tmpname" => $image_name
    );
    echo json_encode($res);    
}else{
    echo "No file found";
}
?>