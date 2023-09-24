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
                <a class="nav-link" href="contact.php"><i class="far fa-id-badge"></i> Contact us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="login.php"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="row " style="width: 100%;">
        <div class="col-6" style="height: 100%;">
            <img src="imgs/help.JFIF" alt="" style="object-fit: cover; width: 100%;">
        </div>
        <div class="col-6 login-form">
            <div><h2 style="color: tomato;">Sign In</h2></div>
            <div class="card  col-md-6" id="login">
                <div class="card-body">
                    <form id="login-form" method="post">
                        <div class="mb-3 mt-4">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                <input type="text" name="username" id="username" class="form-control form-control-sm" aria-describedby="username">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                <input type="password" name="password" id="password" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="login_error mb-3" id="login_error"></div>
                        <div class="d-flex justify-content-center">
                        <button type="submit" id="submit" name="submit" class="btn btn-success col-6">Login</button> 
                        </div>
                    </form>
                    <div class="pt-5">
                        <span>Don't Have an Account? <a href="register.php">Register</a></span>
                    </div>
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
<script>

    document.querySelector("#username").addEventListener("focusout", ()=>{

        let loginForm = document.querySelector("#login-form");

        let value = document.querySelector("#username").value;

        let param = "check_username="+value;
        
        let xhr = new XMLHttpRequest();

        xhr.open('POST', 'scripts/check_username.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){
            if (this.status == 200) {

                let feedback = JSON.parse(this.responseText)
                
                if (feedback.response === true) {

                    document.querySelector("#username").classList.remove("is-invalid");
                    document.querySelector(".login_error").innerText = "";
                    document.querySelector("#username").classList.add("is-valid");
                    
                }else{

                    document.querySelector("#username").classList.remove("is-valid");
                    document.querySelector("#username").classList.add("is-invalid");
                    document.querySelector(".login_error").innerText = "username does not exist";

                }
               
            }
        }

        xhr.send(param);
    });

    document.querySelector("#submit").addEventListener("click", (e)=>{

        e.preventDefault();

        let loginForm = document.querySelector("#login-form");
        
        let xhr = new XMLHttpRequest();

        xhr.open('POST', 'scripts/login_auth.php', true);

        xhr.onload = function(){
            if (this.status == 200) {

                let feedback = JSON.parse(this.responseText)
                
                let response = feedback.response;

                switch (response) {
                    case 1:
                        document.querySelector("#username").classList.add("is-invalid");
                        document.querySelector("#password").classList.add("is-invalid");
                        document.querySelector(".login_error").innerText = "Username & Password did not match";
                        break;
                    case 2:
                        document.querySelector("#username").classList.add("is-invalid");
                        document.querySelector("#password").classList.add("is-invalid");
                        document.querySelector(".login_error").innerText = "Please enter usernsme & password";
                        break;
                    case 3:
                        document.querySelector("#username").classList.add("is-invalid");
                        document.querySelector(".login_error").innerText = "please enter username";
                        break;
                    case 4:
                        document.querySelector("#password").classList.add("is-invalid");
                        document.querySelector(".login_error").innerText = "Please enter password";
                        break;
                    case 5:
                        document.querySelector(".login_error").innerText = "Please enter password";
                        break;
                    default:
                        window.location.href = feedback.location;
                }
                
               
            }
        }
        let data = new FormData(loginForm);
        xhr.send(data);
    });


</script>
</html>