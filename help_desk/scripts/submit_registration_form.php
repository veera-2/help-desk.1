<?php session_start();

include 'class_auto_loader.php';

if (isset($_FILES["inf-img"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $first_name = $_POST["first_name"];
    $surname = $_POST["surname"];
    $other_name = $_POST["other_name"];
    $gender = $_POST["gender"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $_FILES["inf-img"]["name"];

    if (!empty($username) && $password === $confirm_password) {

        $controler = new Controler();
        $account_type = "user";

        $id = $controler->create_login($username, $password, $account_type);

        if(!empty($id)){

            $file = $_FILES['inf-img'];

            $fileName = $_FILES['inf-img']['name'];
            $fileTmpName = $_FILES['inf-img']['tmp_name'];
            $fileSize = $_FILES['inf-img']['size'];
            $fileerror = $_FILES['inf-img']['error'];
            $fileType = $_FILES['inf-img']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('png', "jpg", "jpeg", 'PNG', "JPG", "JPEG");

            if (in_array($fileActualExt, $allowed)){

                if ($fileerror === 0) {

                    if ($fileSize < 10000000) {

                        $fileNewName = uniqid('',true).".".$fileActualExt;
                        $fileDestination = '../passports/'.$fileNewName;
                        move_uploaded_file($fileTmpName, $fileDestination);

                        $_SESSION["user_id"] = $id;
                        $_SESSION["username"] = $username;
                        $_SESSION["account_type"] = $account_type;

                        $controler->add_user_info($id, $first_name, $surname, $other_name, $gender, $address, $phone_number, $email, $fileNewName);

                    }else {
                        echo 'file too big';
                    }
                }else {
                    echo 'error uploading file';
                }

            }else {
                echo 'File format not allowed';
            }
        }
    }

}else{

    echo "Review the form and submit again";

}

?>