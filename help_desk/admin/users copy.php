<?php
    session_start();

    include '../scripts/class_auto_loader.php';


    if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "admin") {
    header("location:../login.php");
    die();
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-plus"></i> Add
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_student">Add Student</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_staff">Add Staff</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_admin">Add Admin</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_ticket">Add Ticket</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link active" href="users.php"><i class="fas fa-users"></i> Users</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="reports.php"><i class="fas fa-file-medical"></i> Reports</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="account.php"><i class="fas fa-user-circle"></i> My Account</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../scripts/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-3">

    <div class="card mb-3 border-light">
        <div class="row g-0">
          <div class="" >
            <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <h6>Admins</h6>
                
                <div>
                    <input type="text" class="search_field" id="search_field_admins" placeholder="  Filter">
                    <i class="fas fa-search"></i>
                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Admin</button>
                </div>
            </div>
            <table class="table table-sm align-middle" style="font-size: 13px">
                <thead>
                    <tr>
                    <th scope="col" style="width:20%">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Username</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">E-mail</th>
                    </tr>
                </thead>
                <tbody id="admin_table_data"></tbody>
            </table>
            <div class="float-end pagination-container">
                <label for="admin_num_records"class="px-1">Rows</label>
                <select type="number" class="form-select form-select-sm px-3" id="admin_num_records" aria-label=".form-select-lg example" style="width: 65px; margin-right:30px">
                    <option selected>5</option>
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
                <i class="fas fa-chevron-left px-1 admin-chevron" id="admin-chevron-left" hidden></i>
                <button class="pagination-btn first">First</button>
                <i class="fas fa-ellipsis-h px-1 admin-ellipsis" hidden></i>
                <div class="pagination-btns">
                </div>
                <i class="fas fa-ellipsis-h px-1 admin-ellipsis" hidden></i>
                <button class="pagination-btn">Last</button>
                <i class="fas fa-chevron-right px-1 admin-chevron" id="admin-chevron-right" hidden></i>
            </div>
            </div>
          </div>
          </div>
      </div>

    <div class="card mb-3">
        <div class="row g-0">
          <div class="" >
            <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <h6>Staffs</h6>
                <div>
                    <input type="text" class="search_field" id="search_field_staffs" placeholder="  Filter">
                    <i class="fas fa-search"></i>
                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Staff</button>
                </div>
            </div>
            
            <table class="table table-sm" style="font-size: 13px">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Department</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">E-mail</th>
                    <th scope="col"style="width:10%">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                    </td>
                    </tr>
                    <tr>
                    <td>Jacob</td>
                    <td>Jacob</td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <td colspan="2">Larry the Bird</td>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
            </div>
          </div>
          </div>
      </div>

    <div class="card mb-3">
        <div class="row g-0">
          <div class="" >
            <div class="card-body">
            <div class="card-title d-flex justify-content-between">
                <h6>Students</h6>
                <div>
                    <input type="text" class="search_field" id="search_field_students" placeholder="  Filter">
                    <i class="fas fa-search"></i>
                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Student</button>
                </div>
            </div>
            <table class="table table-sm" style="font-size: 13px">
                <thead>
                    <tr>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
            </table> 
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
<script src="../js/bootstrap.min.js"></script>
<script>

    function getAdmins (limit, offset){
         let xhr = new XMLHttpRequest();

        let params = "get=admins&limit="+limit+"&offset="+offset;
        document.querySelector("#admin_table_data").innerHTML='';

        xhr.open('POST', 'scripts/admins.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {

                 admins = JSON.parse(this.responseText)

                let output = "";

                for (let i in admins) {

                        output += '<tr>'+
                        '<td style="">'+admins[i].name+'</td>'+
                        '<td><div style="display: flex;align-items: center; justify-content:center; width: 30px;height:30px; border-radius:50%; border:2px solid tomato"><img style="object-fit:fil;position: relative;width:100%;height:100%; border-radius:50%;" src="../imgs/help_desk_5.png" alt="help_desk_1.png"></div></td>'+
                        '<td>'+admins[i].username+'</td>'+
                        '<td>'+admins[i].phoneNumber+'</td>'+
                        '<td>'+admins[i].eMail+'</td>'+
                        '</tr>';
                }

                document.querySelector("#admin_table_data").innerHTML = output;
            }
        }
        xhr.send(params);
    }


    window.onload = function (){
        getAdmins(5, 0);
    }

</script>
</html>