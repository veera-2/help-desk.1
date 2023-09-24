<?php
session_start();

include '../scripts/class_auto_loader.php';


if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "admin") {
header("location:../login.php");
die();
}

$view = new View();

if ($_POST["get"]=="admins") {

    $limit = $_POST["limit"];
    $offset = $_POST["offset"];

    echo json_encode($view->get_admins($limit, $offset));
}

if ($_POST["get"]=="adminsLength") {

    echo json_encode($view->admins_length());
}
