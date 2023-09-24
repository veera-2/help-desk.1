<?php

    session_start();

    include '../scripts/class_auto_loader.php';


    if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "support") {
    header("location:../login.php");
    die();
    }

    $id = $_SESSION["user_id"];


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

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AUK HELP-DESK SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                <a class="nav-link"  aria-current="page" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
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
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-sm">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="surname" class="form-label">Surname</label>
                                    <input type="text" name="surname" id="surname" class="form-control form-control-sm">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="other_name" class="form-label">Other Name</label>
                                    <input type="text" name="other_name" id="other_name" class="form-control form-control-sm">
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
                                    <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="text" name="email" id="email" class="form-control form-control-sm">
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" name="department" id="department" class="form-control form-control-sm" readonly>
                                </div>
                                <div class="mb-4 col-6">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" name="role" id="role" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-share-square">&ensp; Change Password</i></button> 
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

    <nav class="navbar sticky-bottom navbar-dark">
        <div class="container justify-content-center">
            <span style="color: white;">Copyright @2021 Al-Qalam University Gusau</span>
        </div>
    </nav>
</body>
<script src="../js/bootstrap.min.js"></script>
<script>

    window.onload = ()=>{

        let id = <?=$id?>;

        details(id);
    }

    function details(id){
        
        let params = "id="+id;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/get_system_administrators.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {

                let details = JSON.parse(this.responseText);

                document.querySelector("#first_name").value = details.first_name;
                document.querySelector("#surname").value = details.surname;
                document.querySelector("#other_name").value = details.other_name;
                document.querySelector("#phone_number").value = details.phone_number;
                document.querySelector("#department").value = details.department_name;
                document.querySelector("#role").value = details.role_name;
                
            }
        }

        xhr.send(params);
    }
</script>
</html>