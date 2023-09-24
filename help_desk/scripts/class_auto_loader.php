<?php

spl_autoload_register('myAutoLoader');
function myAutoLoader($className){

    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    if (strpos($url, 'scripts') !== false) {
        $path = "../classes/";
    } else {
        $path = "classes/";
    }
    
    $extension = ".php";
    $fullPath = $path.$className.$extension;

    if (!file_exists($fullPath)) {
        return false;
    }
    
    include_once $fullPath;
}   include 'check.php';