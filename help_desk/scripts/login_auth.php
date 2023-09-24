<?php 
session_start();

include 'class_auto_loader.php';

$Controler = new Controler();

if (!empty($_POST["password"]) && !empty($_POST["username"]) ) {

    $password = $_POST["password"];
    $username = $_POST["username"];

    $result = $Controler->login_auth($username, $password);

    if ($result) {

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["username"] = $result["username"];
        $_SESSION["account_type"] = $result["account_type"];

        if ($_SESSION["account_type"] === "admin") {

            echo json_encode(["location" => "admin/index.php"]);

        }elseif ($_SESSION["account_type"] === "support") {

            echo json_encode(["location" => "support/index.php"]);

        }elseif ($_SESSION["account_type"] === "user") {

            echo json_encode(["location" => "students/index.php"]);

        }else {
            echo '{"response":5}';
        }

    }else {
        echo '{"response":1}';
    }



}elseif (empty($_POST["password"]) && empty($_POST["username"])) {

    echo '{"response":2}';

}elseif (empty($_POST["username"]) ) {

    echo '{"response":3}';

}elseif (empty($_POST["password"]) ) {

    echo '{"response":4}';

}



?>