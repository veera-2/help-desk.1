<?php session_start();

include 'class_auto_loader.php';

        $controler = new Controler();

if (!empty($_POST["admin_username"])) {

    $username = $_POST["admin_username"];
    $password = $_POST["admin_password"];
    $confirm_password = $_POST["admin_confirm_password"];
    $first_name = $_POST["admin_first_name"];
    $surname = $_POST["admin_surname"];
    $other_name = $_POST["admin_other_name"];
    $gender = $_POST["admin_gender"];
    $phone_number = $_POST["admin_phone_number"];
    $department = $_POST["admin_select_department"];
    $role = $_POST["admin_select_role"];
    $account_type = strtolower($controler->role($role));

    if (!empty($username) && $password === $confirm_password) {

        $id = $controler->create_login($username, $password, $account_type);

        $controler->add_admin_info($id, $first_name, $surname, $other_name, $gender, $phone_number, $department, $role);
        
    }else {
        echo "password does not match";
    }

}else{

    echo "Review the form and submit again";

}

?>