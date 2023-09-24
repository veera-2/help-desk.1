<?php
    session_start();

    include '../scripts/class_auto_loader.php';


    if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "staff") {
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
                <a class="nav-link active"  aria-current="page" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Raise Tickets</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">My Account</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../scripts/logout.php">Logout</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <h2 class="mb-4">Dashboard</h2>
                <div class="row justify-content-evenly">
                    <div class="card col-md-2 border-light" style="background-color: orange; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Tickets</h6>
                            <h3>40</h3>
                        </div>
                    </div>
                    <div class="card col-md-2 border-light" style="background-color: gray; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Open Tickets</h6>
                            <h3>40</h3>
                        </div>
                    </div>
                    <div class="card col-md-2 border-light" style="background-color: tomato; color:whitesmoke;">
                        <div class="card-body">
                        <h6>Closed Ticket</h6>
                        <h3>40</h3>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 style="color: mediumseagreen;">New Tickets</h5>
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
                                <tr style="border-left: 3px solid mediumseagreen;">
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
                                <tr style="border-left: 3px solid mediumseagreen;">
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
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 style="color: violet;">Open Tickets</h5>
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
                                <tr style="border-left: 3px solid violet;">
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
                                <tr style="border-left: 3px solid violet;">
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
                <div class="card mt-4">
                    <div class="card-body">
                        <h5  style="color: dodgerblue;">Closed Tickets</h5>
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
                                <tr style="border-left: 3px solid dodgerblue;">
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
                                <tr style="border-left: 3px solid dodgerblue;">
                                <td>Jacob</td>
                                <td>Jacob</td>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr style="border-left: 3px solid dodgerblue;">
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
    </div>

    <nav class="navbar sticky-bottom navbar-dark">
        <div class="container justify-content-center">
            <span style="color: white;">Copyright @2021 Al-Qalam University Katsina</span>
        </div>
    </nav>

</body>
<script src="../js/bootstrap.min.js"></script>
<script>


</script>
</html>