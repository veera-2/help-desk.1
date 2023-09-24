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
                <div id="admins_table_container">
                    <table class="table table-sm align-middle" style="font-size: 13px">
                        <thead>
                            <tr>
                                <th scope="col" style="width:7%">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Role</th>
                                <th scope="col" style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="admin_table_data"></tbody>
                    </table>
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
                <h6>Support Staffs</h6>
                <div>
                    <input type="text" class="search_field" id="search_field_staffs" placeholder="  Filter">
                    <i class="fas fa-search"></i>
                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Support Staff</button>
                </div>
            </div>
           <div id="support_table_container">
            <table class="table table-sm" style="font-size: 13px">
                    <thead>
                        <tr>
                        <th scope="col" style="width:7%">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Department</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Role</th>
                            <th scope="col"style="width:10%">action</th>
                        </tr>
                    </thead>
                    <tbody id="support_table_data"></tbody>
                </table>
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
                <h6>Users</h6>
                <div>
                    <input type="text" class="search_field" id="search_field_students" placeholder="  Filter">
                    <i class="fas fa-search"></i>
                    <button type="button" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Users</button>
                </div>
            </div>
            <div id="users_table_container">
                <table class="table table-sm" style="font-size: 13px">
                    <thead>
                        <tr>
                            <th scope="col" style="width:7%">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Email</th>
                            <th scope="col"style="width:10%">action</th>
                        </tr>
                    </thead>
                    <tbody id="users_table_data"></tbody>
                </table> 
            </div>
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

    <?php include '../includes/modals.php';?>
</body>
<script src="../js/bootstrap.min.js"></script>
<script>

    window.onload = function(){
        admins();
        support_staff();
        users();
    }

  function admins(){

    let count = 0;

    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_system_administrators.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let tr = document.createElement("tr");

            let system_users = JSON.parse(this.responseText);

            for (let i in system_users) {

                if (system_users[i].account_type == "admin") {

                    count++
                    let code = "code";

                    let td_1 = document.createElement("td");
                    let div = document.createElement("div");
                    let img = document.createElement("img");
                    div.style.display = "flex"
                    div.style.alignItems = "center";
                    div.style.justifyContent = "content";
                    div.style.width = "30px";
                    div.style.height = "30px";
                    div.style.borderRadius = "50%";
                    div.style.border = "2px solid dodgerblue";

                    img.style.objectFit = "fill";
                    img.style.position = "relative";
                    img.style.height = "100%";
                    img.style.width = "100%";
                    img.style.borderRadius = "50%";

                    img.setAttribute("src", "")
                    img.setAttribute("alt", "image")

                    div.appendChild(img)
                    td_1.appendChild(div);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(system_users[i].first_name+" "+system_users[i].surname);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(system_users[i].username);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(system_users[i].phone_number);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(system_users[i].role_name);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6.classList.add("action_btns");

                    let button_1 = document.createElement("button");
                    
                    button_1.setAttribute("type", "button");
                    button_1.setAttribute("onclick", "edit_admin()");
                    button_1.setAttribute("target", system_users[i].id);
                    button_1.setAttribute("name", system_users[i].username);
                    button_1.classList.add("btn");
                    button_1.classList.add("btn-warning");
                    button_1.classList.add("btn-sm");
                    
                    let i_1 = document.createElement("i");
                    
                    i_1.setAttribute("target", system_users[i].id);
                    i_1.setAttribute("name", system_users[i].username);
                    i_1.classList.add("far");
                    i_1.classList.add("fa-edit");
                    
                    button_1.appendChild(i_1);
                    
                    let button_2 = document.createElement("button");
                    
                    button_2.setAttribute("type", "button");
                    button_2.setAttribute("onclick", "change_password()");
                    button_2.setAttribute("target", system_users[i].id);
                    button_2.setAttribute("name", system_users[i].username);
                    button_2.classList.add("btn");
                    button_2.classList.add("btn-outline-secondary");
                    button_2.classList.add("btn-sm");
                    
                    let i_2 = document.createElement("i");
                    
                    i_2.setAttribute("target", system_users[i].id);
                    i_2.setAttribute("name", system_users[i].username);
                    i_2.classList.add("fas");
                    i_2.classList.add("fa-key");
                    
                    button_2.appendChild(i_2)
                    
                    let button_3 = document.createElement("button");
                    
                    button_3.setAttribute("type", "button");
                    button_3.setAttribute("onclick", "delete_user()");
                    button_3.setAttribute("target", system_users[i].id);
                    button_3.setAttribute("name", system_users[i].username);
                    button_3.setAttribute("account_type", "admin");
                    button_3.classList.add("btn");
                    button_3.classList.add("btn-danger");
                    button_3.classList.add("btn-sm");
                    
                    let i_3 = document.createElement("i");
                    
                    i_3.setAttribute("target", system_users[i].id);
                    i_3.setAttribute("mame", system_users[i].username);
                    i_3.setAttribute("account_type", "admin");
                    i_3.classList.add("far");
                    i_3.classList.add("fa-trash-alt");
                    
                    button_3.appendChild(i_3)

                    td_6.appendChild(button_1)
                    td_6.appendChild(button_2)
                    td_6.appendChild(button_3)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("dodgerblue");
                    tr.appendChild(td_6);

                    document.querySelector("#admin_table_data").appendChild(tr)

                }
            }

            if (count <= 0) {
                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#admins_table_container").innerHTML = div;
            }
        }
    }
    xhr.send();
}

function support_staff(){

    let count = 0;

    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_system_administrators.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let system_users = JSON.parse(this.responseText);

            let tr = document.createElement("tr");

            for (let i in system_users) {

                if (system_users[i].account_type == "support") {

                    count++
                    let code = "code";

                    let td_1 = document.createElement("td");
                    let div = document.createElement("div");
                    let img = document.createElement("img");
                    div.style.display = "flex"
                    div.style.alignItems = "center";
                    div.style.justifyContent = "content";
                    div.style.width = "30px";
                    div.style.height = "30px";
                    div.style.borderRadius = "50%";
                    div.style.border = "2px solid grey";

                    img.style.objectFit = "fill";
                    img.style.position = "relative";
                    img.style.height = "100%";
                    img.style.width = "100%";
                    img.style.borderRadius = "50%";

                    img.setAttribute("src", "")
                    img.setAttribute("alt", "image")

                    div.appendChild(img)
                    td_1.appendChild(div);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(system_users[i].first_name+" "+system_users[i].surname);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(system_users[i].username);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(system_users[i].department_name);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(system_users[i].phone_number);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(system_users[i].role_name);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_7 = document.createElement("td");
                    td_7.classList.add("action_btns");

                    let button_1 = document.createElement("button");
                    
                    button_1.setAttribute("type", "button");
                    button_1.setAttribute("onclick", "edit_admin()");
                    button_1.setAttribute("target", system_users[i].id);
                    button_1.setAttribute("name", system_users[i].username);
                    button_1.classList.add("btn");
                    button_1.classList.add("btn-warning");
                    button_1.classList.add("btn-sm");
                    
                    let i_1 = document.createElement("i");
                    
                    i_1.setAttribute("target", system_users[i].id);
                    i_1.setAttribute("name", system_users[i].username);
                    i_1.classList.add("far");
                    i_1.classList.add("fa-edit");
                    
                    button_1.appendChild(i_1);
                    
                    let button_2 = document.createElement("button");
                    
                    button_2.setAttribute("type", "button");
                    button_2.setAttribute("onclick", "change_password()");
                    button_2.setAttribute("target", system_users[i].id);
                    button_2.setAttribute("name", system_users[i].username);
                    button_2.classList.add("btn");
                    button_2.classList.add("btn-outline-secondary");
                    button_2.classList.add("btn-sm");
                    
                    let i_2 = document.createElement("i");
                    
                    i_2.setAttribute("target", system_users[i].id);
                    i_2.setAttribute("name", system_users[i].username);
                    i_2.classList.add("fas");
                    i_2.classList.add("fa-key");
                    
                    button_2.appendChild(i_2)
                    
                    let button_3 = document.createElement("button");
                    
                    button_3.setAttribute("type", "button");
                    button_3.setAttribute("onclick", "delete_user()");
                    button_3.setAttribute("target", system_users[i].id);
                    button_3.setAttribute("name", system_users[i].username);
                    button_3.setAttribute("account_type", "support");
                    button_3.classList.add("btn");
                    button_3.classList.add("btn-danger");
                    button_3.classList.add("btn-sm");
                    
                    let i_3 = document.createElement("i");
                    
                    i_3.setAttribute("target", system_users[i].id);
                    i_3.setAttribute("name", system_users[i].username);
                    i_3.setAttribute("account_type", "support");
                    i_3.classList.add("far");
                    i_3.classList.add("fa-trash-alt");
                    
                    button_3.appendChild(i_3)

                    td_7.appendChild(button_1)
                    td_7.appendChild(button_2)
                    td_7.appendChild(button_3)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("grey");
                    tr.appendChild(td_7);

                    document.querySelector("#support_table_data").appendChild(tr);

                }
            }

            if (count <= 0) {

                let div = document.createElement("h3");

                div.classList.add("text-center");
                div.innerText = ("No record found");
                document.querySelector("#support_table_data").appendChild(div);

            }
        }
    }
    xhr.send();
}

function users(){

    let count = 0;

    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_system_users.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let system_users = JSON.parse(this.responseText);

            let tr = document.createElement("tr");

            for (let i in system_users) {

                if (system_users[i].account_type == "user") {

                    count++
                    let code = "code";

                    let tr = document.createElement("tr");

                    let td_1 = document.createElement("td");
                    let div = document.createElement("div");
                    let img = document.createElement("img");
                    div.style.display = "flex"
                    div.style.alignItems = "center";
                    div.style.justifyContent = "content";
                    div.style.width = "30px";
                    div.style.height = "30px";
                    div.style.borderRadius = "50%";
                    div.style.border = "2px solid slateblue";

                    img.style.objectFit = "fill";
                    img.style.position = "relative";
                    img.style.height = "100%";
                    img.style.width = "100%";
                    img.style.borderRadius = "50%";

                    img.setAttribute("src", "../passports/"+system_users[i].image)
                    img.setAttribute("alt", "image")

                    div.appendChild(img)
                    td_1.appendChild(div);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(system_users[i].first_name+" "+system_users[i].surname);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(system_users[i].username);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(system_users[i].phone_number);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(system_users[i].email_address);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6.classList.add("action_btns");

                    let button_1 = document.createElement("button");
                    
                    button_1.setAttribute("type", "button");
                    button_1.setAttribute("onclick", "edit_user()");
                    button_1.setAttribute("target", system_users[i].id);
                    button_1.setAttribute("name", system_users[i].id);
                    button_1.classList.add("btn");
                    button_1.classList.add("btn-warning");
                    button_1.classList.add("btn-sm");
                    
                    let i_1 = document.createElement("i");
                    
                    i_1.setAttribute("target", system_users[i].id);
                    i_1.setAttribute("name", system_users[i].username);
                    i_1.classList.add("far");
                    i_1.classList.add("fa-edit");
                    
                    button_1.appendChild(i_1);
                    
                    let button_2 = document.createElement("button");
                    
                    button_2.setAttribute("type", "button");
                    button_2.setAttribute("target", system_users[i].id);
                    button_2.setAttribute("name", system_users[i].username);
                    button_2.classList.add("btn");
                    button_2.classList.add("btn-outline-secondary");
                    button_2.classList.add("btn-sm");
                    button_2.setAttribute("onclick", "change_password()");
                    
                    let i_2 = document.createElement("i");
                    
                    i_2.setAttribute("target", system_users[i].id);
                    i_2.setAttribute("name", system_users[i].username);
                    i_2.classList.add("fas");
                    i_2.classList.add("fa-key");
                    
                    button_2.appendChild(i_2)
                    
                    let button_3 = document.createElement("button");
                    
                    button_3.setAttribute("type", "button");
                    button_3.setAttribute("onclick", "delete_user()");
                    button_3.setAttribute("target", system_users[i].id);
                    button_3.setAttribute("name", system_users[i].username);
                    button_3.setAttribute("account_type", "user");
                    button_3.classList.add("btn");
                    button_3.classList.add("btn-danger");
                    button_3.classList.add("btn-sm");
                    
                    let i_3 = document.createElement("i");
                    
                    i_3.setAttribute("target", system_users[i].id);
                    i_3.setAttribute("name", system_users[i].username);
                    i_3.setAttribute("account_type", "user");
                    i_3.classList.add("far");
                    i_3.classList.add("fa-trash-alt");
                    
                    button_3.appendChild(i_3);

                    td_6.appendChild(button_1);
                    td_6.appendChild(button_2);
                    td_6.appendChild(button_3);

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("slateblue");
                    tr.appendChild(td_6);

                    document.querySelector("#users_table_data").appendChild(tr);

                }
            }
            
            if (count <= 0) {

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#users_table_container").appendChild(div);

            }
        }
    }
    xhr.send();
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

function edit_user(){

    clear_users_modal();

    document.querySelector("#users_modal_title").innerText = "Edit";
    document.querySelector("#users_modal_body").innerHTML = "";
    document.querySelector("#users_modal_btn").removeAttribute("onclick")
    document.querySelector("#users_modal_btn").innerHTML = "adasdd";

    document.querySelector("#users_modal_trigger_btn").click();
}

function edit_admin(){

    clear_users_modal();

    document.querySelector("#users_modal_title").innerText = "Edit";
    document.querySelector("#users_modal_body").innerHTML = "";
    document.querySelector("#users_modal_btn").removeAttribute("onclick")
    document.querySelector("#users_modal_btn").innerHTML = "adasdd";

    document.querySelector("#users_modal_trigger_btn").click();
}

function change_password(){

    clear_users_modal();

    let id = this.event.target.getAttribute("target");
    let username = this.event.target.getAttribute("name");

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
    input_1.setAttribute("id", "change_password");
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
    input_2.setAttribute("id", "confirm_change_password");
    input_2.classList.add("form-control")
    input_2.classList.add("form-control-sm")

    div_2.appendChild(label_2);
    div_2.appendChild(input_2);

    form.appendChild(div_1)
    form.appendChild(div_2)

    document.querySelector("#users_modal_title").innerText = "Change "+username+"'s Password";
    document.querySelector("#users_modal_body").appendChild(form);
    document.querySelector("#users_modal_btn").setAttribute("onclick", "update_password("+id+")")
    document.querySelector("#users_modal_btn").classList.add("btn-warning")
    document.querySelector("#users_modal_btn").innerHTML = '<i class="fas fa-key">&ensp;</i> Change Password';

    document.querySelector("#users_modal_trigger_btn").click();
}

function update_password(id){
    
    let password = document.querySelector("#change_password").value;
    let confirm = document.querySelector("#confirm_change_password").value;
    
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
        document.querySelector("#change_password").classList.add("is-invalid");
        document.querySelector("#confirm_change_password").classList.add("is-invalid");
    }
}

function delete_user(){

    clear_users_modal();

    let id = this.event.target.getAttribute("target");
    let username = this.event.target.getAttribute("name");
    let account_type = this.event.target.getAttribute("account_type");

    document.querySelector("#users_modal_title").innerText = "Delete "+username;
    document.querySelector("#users_modal_body").innerHTML = '<h5 class="text-center">Are you sure want to delete this user?</h5>';
    document.querySelector("#users_modal_btn").setAttribute("onclick", "confirm_delete_user("+id+")");
    document.querySelector("#users_modal_btn").setAttribute("account_type", account_type);
    document.querySelector("#users_modal_btn").classList.add("btn-danger")
    document.querySelector("#users_modal_btn").innerHTML = '<i class="fas fa-trash-alt">&ensp;</i> Delete';

    document.querySelector("#users_modal_trigger_btn").click();
}

function confirm_delete_user(id){

    let account_type = document.querySelector("#users_modal_btn").getAttribute("account_type");
    
    let params = "id="+id;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/delete_user.php', true);

    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){

        if (this.status == 200) { console.log(this.responseText)
            
            if (this.responseText == "deleted") {

                if (account_type == "admin") {
                    document.querySelector("#users_table_container").innerText = "";
                    admins();
                }else if(account_type == "support"){
                    document.querySelector("#users_table_container").innerText = "";
                    support_staff()
                }else if (account_type == "user") {
                    document.querySelector("#users_table_container").innerText = "";
                    users();
                }

                document.querySelector("#users_modal_close").click();
                    
            }else{

                console.log(this.responseText)
            }
        }
    }

    xhr.send(params);
    document.querySelector("#users_modal_close").click();
}

</script>
</html>