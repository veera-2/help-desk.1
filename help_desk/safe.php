<?php
    session_start();

    include 'scripts/class_auto_loader.php';


    if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "student") {
    header("location:../login.php");
    die();
    }
    $id = $_SESSION["user_id"];

    $controler = new Controler();

    $problem_categories = $controler->problem_categories();
    $ticket_priorities = $controler->ticket_priorities();
    $ticket_type = $controler->ticket_type();

    $open_tickets = $controler->user_tickets($id);

?>
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
    <button id="delete_ticket_btn" data-bs-toggle="modal" data-bs-target="#delete_ticket_modal" hidden>delete ticket</button>
    <button id="raise_ticket" data-bs-toggle="modal" data-bs-target="#add_ticket" hidden>raise ticket</button>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-ticket-alt"></i> AUK HELP-DESK SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                <a class="nav-link active"  aria-current="page" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                <a class="nav-link add_ticket" href="#" onclick="raise_ticket()"><i class="fas fa-plus"></i> Raise Tickets</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-user-circle"></i> My Account</a>
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
                <h2 class="mb-4"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
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
                                <th scope="col">S/N</th>
                                <th scope="col">Code</th>
                                <th scope="col">Title</Title></th>
                                <th scope="col">Description</th>
                                <th scope="col">Date Logged</th>
                                <th scope="col">Problem Category</th>
                                <th scope="col"style="width:10%">action</th>
                                </tr>
                            </thead>
                            <tbody  style="border-left: 3px solid mediumseagreen;">
                                <?php foreach ($open_tickets as $row): ?>
                                    <tr>
                                    <td>1</td>
                                    <td><?=$row["code"]?></td>
                                    <td><?=$row["ticket_title"]?></td>
                                    <td><?=$row["ticket_description"]?></td>
                                    <td><?=date('d M, Y', strtotime($row["date_logged"]))?></td>
                                    <td><?=$row["category_description"]?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" onclick="edit_ticket('<?=$row['code']?>')"><i class="far fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_ticket('<?=$row['code']?>')"><i class="far fa-trash-alt"></i></button>
                                    </td>
                                    </tr>
                                <?php endforeach;?>
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

    <?php include '../includes/modals.php';?>
</body>
<script src="../js/bootstrap.min.js"></script>
<script> 

let ticket_file = document.querySelector("#ticket_file");
let ticket_form = document.querySelector("#ticket_form");

document.querySelector("#add_file_btn").addEventListener("click", ()=>{ticket_file.click()});

document.querySelector("#submit_ticket_btn").addEventListener("click", ()=>{submit_ticket()});

let uploaded_files = [];

ticket_file.onchange = ({target}) => {

    let file = target.files[0];

    if (file) {
        prepare_files(file);
    }
};

function prepare_files(uploaded_file){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../scripts/file_check.php", true);

    xhr.upload.addEventListener("progress", ({loaded, total}) => {

       let percentageLoaded = Math.floor((loaded/total) * 100);
        
       document.querySelector("#progress_container").style.display = "flex";
       document.querySelector("#progress_file_name").innerText = uploaded_file.name;
       document.querySelector("#progress_bar_parcentage").innerText = percentageLoaded+"%";
       document.querySelector("#progress_bar").style.width = percentageLoaded+"%";

    });

    xhr.onload = function(){

        if (this.status == 200) {

            document.querySelector("#progress_container").style.display = "none";
            document.querySelector("#progress_bar").style.width = "0%";

            let file_feedback = JSON.parse(this.responseText);
            let feedback = file_feedback["feedback"];

            if (feedback == true) {

                uploaded_files.push(uploaded_file);
                
                let file_name = uploaded_file.name;
                var size = uploaded_file.size;

                switch (true) {
                    case (size > 999 && size <= 99999):

                        var size = Math.round(uploaded_file.size/1000)+" KB";
                        break;
                
                    case (size > 99999):

                        var size = Math.round(uploaded_file.size/1000000)+" MB";
                        break;
                
                    default:

                        var size = uploaded_file.size+" B";
                        break;
                }

                let node_1 = document.createElement("div");
                node_1.classList.add("uploaded_file");
                node_1.classList.add("mb-2");

                let node_2 = document.createElement("span");

                let node_2_1 = document.createElement("i");
                node_2_1.classList.add("fas");
                node_2_1.classList.add("fa-file-alt");

                let node_2_text = document.createTextNode(" "+file_name);

                node_2.appendChild(node_2_1);
                node_2.appendChild(node_2_text);

                let node_3 = document.createElement("span");

                let node_3_1 = document.createElement("i");
                node_3_1.classList.add("far");
                node_3_1.classList.add("fa-times-circle");

                let node_3_text = document.createTextNode(size+" ");

                node_3.appendChild(node_3_text);
                node_3.appendChild(node_3_1);

                node_1.appendChild(node_2);
                node_1.appendChild(node_3);

                document.querySelector(".uploaded_files_container").appendChild(node_1);

                //console.log(uploaded_files)
                
            }
            
        }
    }
    
    var data = new FormData(ticket_form);
    xhr.send(data);
}

function submit_ticket(){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../scripts/submit_ticket.php", true);

    xhr.onload = function(){

        if (this.status == 200) {

            console.log(this.responseText);

            if (this.responseText == "submitted") {
                
                location.reload()
            }
            
        }
    }
    
    var data = new FormData(ticket_form);
    xhr.send(data);
}

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

function edit_ticket(code){

    let params = "code="+code;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/get_ticket.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        if (this.status == 200) {

            let ticket = JSON.parse(this.responseText);
            console.log(ticket["code"]);
            
            document.querySelector(".uploaded_files_container").innerText = "";
            document.querySelector("#ticket_code").value = ticket["code"];
            document.querySelector("#title").value = ticket["ticket_title"];
            document.querySelector("#description").value = ticket["ticket_description"];
            document.querySelector("#"+ticket["type_description"].replace(" ","_")).setAttribute("selected", "selected");
            document.querySelector("#"+ticket["category_description"].replace(" ","_")).setAttribute("selected", "selected");
            document.querySelector("#"+ticket["priority_description"].replace(" ","_")).setAttribute("selected", "selected");
            document.querySelector("#submit_ticket_btn").classList.add("btn-warning");
            document.querySelector("#submit_ticket_btn").innerHTML = "<i class='far fa-edit'>&ensp;</i>Update";
            document.querySelector("#attachment_area").style.display = "none";
            document.querySelector("#raise_ticket_modal_title").innerText = "Update Ticket: "+ticket["code"];
            
            document.querySelector("#raise_ticket").click();
        }
    }
    xhr.send(params);
}

function delete_ticket(code){
    document.querySelector("#delete_ticket_btn").click();
    document.querySelector("#delete_ticket_input").value = code;
    document.querySelector("#delete_ticket_code").innerText = code;
}

</script>
</html>