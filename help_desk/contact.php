<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

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
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="about.php"><i class="fas fa-align-center"></i> About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" aria-current="page"  href="register.php"><i class="fas fa-user-edit"></i> Register</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="contact.php"><i class="far fa-id-badge"></i> Contact us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

   <div>
       
        <div class="login-form mt-4" style="width: 100%;">
            <div class="card  col-md-6" id="login">
                <div class="card-body">
                    <h3 class="card-title d-flex justify-content-center mb-5"><i class="far fa-id-badge"></i>&ensp; Contact Us</h3>
                    <form class="row mt-3 d-flex">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Contact</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Phone/E-mail">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Message</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-success btn-sm px-5">Send&ensp;<i class="far fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar fixed-bottom navbar-dark">
        <div class="container justify-content-center">
            <span style="color: white;">Copyright @2021 Al-Qalam University Katsina</span>
        </div>
    </nav>
</body>
<script src="js/bootstrap.min.js"></script>
</html>