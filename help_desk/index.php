<?php
include 'scripts/class_auto_loader.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <title>Document</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">AUK HELP-DESK SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="about.php"><i class="fas fa-align-center"></i> About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="register.php"><i class="fas fa-user-edit"></i> Register</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="register.php"><i class="far fa-id-badge"></i> Contact us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="">

        <div class="card bg-dark text-white">
            <img src="imgs/help_desk_4.jpg" class="card-img" alt="..." style="width: 100%; height: 400px;">
            <div class="card-img-overlay" style="display: flex; align-items:cneter; justify-content:center; color:tomato;">
                <h3 class="card-title" style="margin-top: 130px;">WELCOME TO HELP DESK SYSTEM</h3>
            </div>
        </div>

        <div class="row d-flex justify-content-evenly" style="width: 100%; margin-top: -150px">
            <div class="card" style="width: 18rem;">
                <img src="imgs/help_desk_5.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="imgs/help_desk_5.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="imgs/help_desk_5.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-dark">
        <div class="container justify-content-center">
            <span style="color: white;">Copyright @2021 Al-Qalam University Gusau</span>
        </div>
    </nav>

    
</body>
<script src="js/bootstrap.min.js"></script>
</html>