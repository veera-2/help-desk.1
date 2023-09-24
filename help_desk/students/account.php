<?php
    session_start();

    include 'scripts/class_auto_loader.php';


    if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "user") {
    header("location:../login.php");
    die();
    }

    $id = $_SESSION["user_id"];

    $controler= new Controler();
    $details = $controler->get_details($_SESSION["user_id"]);

    $problem_categories = $controler->problem_categories();
    $ticket_priorities = $controler->ticket_priorities();
    $ticket_type = $controler->ticket_type();

    if (isset($_POST["update_details"])) {
        $id = $_SESSION["user_id"];
        $first_name = $_POST["first_name"];
        $surname = $_POST["surname"];
        $other_name = $_POST["other_name"];
        $gender = $_POST["gender"];
        $phone_number = $_POST["phone_number"];
        $email = $_POST["email"];
        $address = $_POST["address"];

        $controler->update_details($id, $first_name, $surname, $other_name, $address, $email, $phone_number, $gender);

        header("location:account.php");
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">

    <title>Document</title>
</head>
<body>

    <button id="raise_ticket" data-bs-toggle="modal" data-bs-target="#add_ticket" hidden>raise ticket</button>
    <button id="users_modal_trigger_btn" data-bs-toggle="modal" data-bs-target="#users_modal" hidden>usersmodal</button>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-ticket-alt"></i> AUK HELP-DESK SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                <a class="nav-link"  aria-current="page" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link add_ticket" href="#" onclick="raise_ticket()"><i class="fas fa-plus"></i> Raise Tickets</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="account.php"><i class="fas fa-user-circle"></i> My Account</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../scripts/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-4" style="color: grey;"><i class="fas fa-user-circle"></i> Account</h2>
                    <div style="background-color:red; width: 60px; height: 60px; border-radius:50%">
                        <img class="img" src="../passports/<?=$details["image"]?>" alt="Passport" style="border-radius: 50%;">
                    </div>
                </div>
                <hr class="divider">
                <div class="row justify-content-center">
                    <div class="col-9">
                        <form class="row mt-3" method="post">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" value="<?=$details["first_name"]?>">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="surname" class="form-label">Surname</label>
                                    <input type="text" name="surname" id="surname" class="form-control form-control-sm" value="<?=$details["surname"]?>">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="other_name" class="form-label">Other Name</label>
                                    <input type="text" name="other_name" id="other_name" class="form-control form-control-sm" value="<?=$details["other_name"]?>">
                                </div>
                                <div class="mb-4 col-md-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select form-select-sm">
                                         <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" value="<?=$details["phone_number"]?>">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control form-control-sm"  value="<?=$details["email_address"]?>">
                                </div>
                                <div class="mb-4 col-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-sm" value="<?=$_SESSION["username"]?>">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" class="form-control form-control-sm" rows="3"><?=$details["address"]?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary btn-sm"><i class="far fa-share-square" onclick="change_password()">&ensp; Change Password</i></button> 
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                            <button type="submit" name="update_details" class="btn btn-warning btn-sm col-3"><i class="far fa-share-square">&ensp; Update</i></button> 
                            </div>
                        </form>
                    </div>
                    
                </div>
                <hr class="divider"> 
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-dark">
        <div class="container justify-content-center">
            <span style="color: white;">Copyright @2021 Al-Qalam University Katsina</span>
        </div>
    </nav>

    <?php include '../includes/modals.php';?>
</body>
<script src="../js/bootstrap.min.js"></script>
<script>

function raise_ticket(){

    document.querySelector("#ticket_code").value = "";
    document.querySelector("#title").value = "";
    document.querySelector("#description").value = "";
    document.querySelector("#ticket_type").firstElementChild.setAttribute("selected", "selected");
    document.querySelector("#problem_category").firstElementChild.setAttribute("selected", "selected");
    document.querySelector("#ticket_priority").firstElementChild.setAttribute("selected", "selected");
    document.querySelector("#submit_ticket_btn").classList.remove("btn-warning");
    document.querySelector("#submit_ticket_btn").innerHTML = '<i class="far fa-paper-plane">&ensp;</i>Send';
    document.querySelector("#attachment_area").style.display = "block";
    document.querySelector("#raise_ticket_modal_title").innerText = "Raise Ticket";

    document.querySelector("#raise_ticket").click();

}

function clear_users_modal(){

    document.querySelector("#users_modal_title").innerText = "";
    document.querySelector("#users_modal_body").innerHTML = "";
    document.querySelector("#users_modal_btn").removeAttribute("onclick")
    document.querySelector("#users_modal_btn").innerHTML = "";
    
    document.querySelector("#users_modal_btn").classList.remove("btn-warning")
    document.querySelector("#users_modal_btn").classList.remove("btn-danger")
    document.querySelector("#users_modal_btn").removeAttribute("account_type");


}

function change_password(){

    var id = <?=$id?>;

    clear_users_modal();


    let form = document.createElement("form");

    form.classList.add("row");
    form.classList.add("g-3");

    let div_1 = document.createElement("div");

    div_1.classList.add("col-md-6");

    let label_1 = document.createElement("label");
    let label_1_text = document.createTextNode("Password")
    label_1.appendChild(label_1_text);

    let input_1 = document.createElement("input");
    input_1.setAttribute("type", "password");
    input_1.setAttribute("name", "password");
    input_1.setAttribute("id", "password");
    input_1.classList.add("form-control")
    input_1.classList.add("form-control-sm")

    div_1.appendChild(label_1);
    div_1.appendChild(input_1);

    let div_2 = document.createElement("div");

    div_2.classList.add("col-md-6");

    let label_2 = document.createElement("label");
    let label_2_text = document.createTextNode("Confirm")
    label_2.appendChild(label_2_text);

    let input_2 = document.createElement("input");
    input_2.setAttribute("type", "password");
    input_2.setAttribute("name", "confirm_password");
    input_2.setAttribute("id", "confirm_password");
    input_2.classList.add("form-control")
    input_2.classList.add("form-control-sm")

    div_2.appendChild(label_2);
    div_2.appendChild(input_2);

    form.appendChild(div_1)
    form.appendChild(div_2)

    document.querySelector("#users_modal_title").innerText = "Change Password";
    document.querySelector("#users_modal_body").appendChild(form);
    document.querySelector("#users_modal_btn").setAttribute("onclick", "update_password("+id+")")
    document.querySelector("#users_modal_btn").classList.add("btn-warning")
    document.querySelector("#users_modal_btn").innerHTML = '<i class="fas fa-key">&ensp;</i> Change Password';

    document.querySelector("#users_modal_trigger_btn").click();
}

function update_password(id){
    
    let password = document.querySelector("#password").value;
    let confirm = document.querySelector("#confirm_password").value;
    
    let params = "id="+id+"&password="+password+"&confirm="+confirm;

    if (password && confirm && password == confirm) {
        
        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/change_password.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {
                
                if (this.responseText == "changed") {

                    console.log("success")
                    document.querySelector("#users_modal_close").click();
                    
                }else{

                    console.log(this.responseText)
                }
            }
        }

        xhr.send(params);
    } else{
        document.querySelector("#password").classList.add("is-invalid");
        document.querySelector("#confirm_password").classList.add("is-invalid");
    }
}

</script>
</html>