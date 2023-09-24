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
                <a class="nav-link active" aria-current="page"  href="register.php"><i class="fas fa-user-edit"></i> Register</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="contact.php"><i class="far fa-id-badge"></i> Contact us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Sign In</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

   <div>
        <div>
            <div class="login-form mt-4 mb-4" style="width: 100%;">
                <div class="card  col-md-6" id="login">
                    <div class="card-body">
                        <h3 class="card-title d-flex justify-content-center mb-3"><i class="fas fa-user-edit"></i>&ensp; User Registration</h3>
                        <hr class="divider">
                        <form name="registration_form" id="registration_form" class="row mt-3" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control form-control-sm" required>
                                    <div class="invalid-feedback">
                                            Username alresdy exist.
                                        </div>
                                </div>
                               <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm" required>
                                        <div class="invalid-feedback">
                                            Psssword does not match.
                                        </div>
                                    </div>
                               </div>
                            </div>
                            <hr class="divider">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="surname" class="form-label">Surname</label>
                                    <input type="text" name="surname" id="surname" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="other_name" class="form-label">Other Name</label>
                                    <input type="text" name="other_name" id="other_name" class="form-control form-control-sm" style="text-transform: capitalize;" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-select form-select-sm">
                                         <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control form-control-sm" id="address" name="address" rows="3" required></textarea>
                                </div>
                                <div class="mb-3 img-upload-container">
                                    <div class="img-upload">
                                        <input type="file" name="inf-img" id="inf-img" hidden required>
                                        <img class="img" src="imgs/avatar.jpeg" alt="Passport" id="passport">
                                        <div class="camera"><i class="fas fa-camera"></i></div>
                                        <div class="" id="progress"></div>
                                        <div id="progress-bar"></div>
                                    </div>
                                    <div id="img-error"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                            <button type="submit" id="submit_form" class="btn btn-primary btn-sm col-3"><i class="far fa-share-square">&ensp; Register</i></button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   </div>

    <nav class="navbar sticky-bottom navbar-dark">
        <div class="container justify-content-center">
            <span style="color: white;">Copyright @2021 Al-Qalam University Katsina</span>
        </div>
    </nav>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<script>

    var form = document.querySelector("#registration_form")

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

                    document.querySelector("#username").classList.remove("is-valid");
                    document.querySelector("#username").classList.add("is-invalid");
                    
                }else{

                    document.querySelector("#username").classList.remove("is-invalid");
                    document.querySelector("#username").classList.add("is-valid");

                }
               
            }
        }

        xhr.send(param);
    });

    document.querySelector("#confirm_password").addEventListener("focusout", ()=>{

        var password = document.querySelector("#password").value;
        var confirm_password = document.querySelector("#confirm_password").value;

        if (password != confirm_password) {
            
            document.querySelector("#password").classList.add("is-invalid");
            document.querySelector("#confirm_password").classList.add("is-invalid");

        }else{

            document.querySelector("#password").classList.remove("is-invalid");
            document.querySelector("#confirm_password").classList.remove("is-invalid");
            document.querySelector("#password").classList.add("is-valid");
            document.querySelector("#confirm_password").classList.add("is-valid");
        }

    });

    document.querySelector("#submit_form").addEventListener("click", (e)=>{

        e.preventDefault();

        var password = document.querySelector("#password").value;
        var confirm_password = document.querySelector("#confirm_password").value;

        if (password != confirm_password) {
            
            console.log("password do not match")
        }else if(document.querySelector("#inf-img").value == 0){
            
            document.querySelector(".img-upload").style.borderColor = "#ffb5b7";
            document.querySelector(".img-upload").style.backgroundColor = "#ffdadb";
            document.querySelector("#img-error").innerText = "Please upload passport";

        }else{
            submit_form();
        }
    });

    function submit_form(){
    
        let xhr = new XMLHttpRequest();
            xhr.open("POST", "scripts/submit_registration_form.php", true);

            xhr.onload = function(){

                if (this.status == 200) {
                    
                    if (this.responseText == "success") {
                        
                        window.location.replace("students/")
                    }
                }
            }


            var data = new FormData(form);
            xhr.send(data);
    }

</script>
</html>