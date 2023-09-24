<?php
    session_start();

    include 'scripts/class_auto_loader.php';


    if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "admin") {
    header("location:../login.php");
    die();
    }

    $controler = new Controler();

    $problem_categories = $controler->problem_categories();
    $ticket_priorities = $controler->ticket_priorities();
    $ticket_type = $controler->ticket_type();
    $departments = $controler->departments();
    $roles = $controler->roles();

    //print_r($departments)

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

    <button id="delete_ticket_btn" data-bs-toggle="modal" data-bs-target="#delete_ticket_modal" hidden>delete ticket</button>
    <button id="assign_ticket_btn" data-bs-toggle="modal" data-bs-target="#assign_ticket_modal" hidden>assign ticket</button>
    <button id="raise_ticket" data-bs-toggle="modal" data-bs-target="#add_ticket" hidden>raise ticket</button>
    <button id="close_ticket" data-bs-toggle="modal" data-bs-target="#close_ticket_modal" hidden>raise ticket</button>
    <button id="view_ticket" data-bs-toggle="modal" data-bs-target="#view_ticket_modal" hidden>view ticket</button>
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
                <a class="nav-link active"  aria-current="page" href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-plus"></i> Add
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_student">Add User</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_admin">Add Admin</a></li>
                        <!-- <li><hr class="dropdown-divider"></li> -->
                        <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add_ticket">Add Ticket</a></li> -->
                    </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="users.php"><i class="fas fa-users"></i> Users</a>
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

    <div class="container mt-4">
        <div class="card border-light">
            <div class="card-body">
                <div class="row justify-content-evenly">
                    <div id="new_tickets" class="card col-md-2 border-light pointer" style="background-color: tomato; color:whitesmoke;">
                        <div class="card-body">
                            <h6>New Tickets</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="new_tickets_counter"></h3>
                                <h3><i class="fas fa-ticket-alt 5x"></i></h3>
                            </span>
                        </div>
                    </div>
                    <div id="assigned_tickets" class="card col-md-2 border-light pointer" style="background-color: violet; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Assigned Tickets</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="assigned_tickets_count"></h3>
                                <h3><i class="fas fa-clipboard-check"></i></h3>
                            </span>
                        </div>
                    </div>
                    <div id="open_tickets" class="card col-md-2 border-light pointer" style="background-color: orange; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Open Tickets</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="open_tickets_count"></h3>
                                <h3><i class="fas fa-envelope-open-text"></i></h3>
                            </span>
                        </div>
                    </div>
                    <div id="close_tickets" class="card col-md-2 border-light pointer" style="background-color: mediumseagreen; color:whitesmoke;">
                        <div class="card-body">
                        <h6>Closed Ticket</h6>
                        <span style="display: flex; justify-content: space-between;">
                                <h3 id="close_tickets_counter"></h3>
                                <h3><i class="fas fa-envelope"></i></h3>
                            </span>
                        </div>
                    </div>
                </div>
                <hr class="divider"> 
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 id="table_title"></h5>
                        <div id="table_container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="card border-light">
            <div class="card-body">
                <div class="row justify-content-evenly">
                    <div id="admins" class="card col-md-2 border-light pointer" style="background-color: dodgerblue; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Admins</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="admins_counter"></h3>
                                <h3><i class="fas fa-users-cog 5x"></i></h3>
                            </span>
                        </div>
                    </div>
                    <div id="support_staff" class="card col-md-2 border-light pointer" style="background-color: grey; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Support Staffs</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="support_staff_counter"></h3>
                                <h3><i class="fas fa-cogs 5x"></i></h3>
                            </span>
                        </div>
                    </div>
                    <div id="users" class="card col-md-2 border-light pointer" style="background-color: slateblue; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Users</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="users_counter"></h3>
                                <h3><i class="fas fa-users 5x"></i></h3>
                            </span>
                        </div>
                    </div>
                </div>
                <hr class="divider"> 
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 id="users_table_title"></h5>
                        <div id="users_table_container"></div>
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
<script src="js/script.js"></script>
<script>

    var form = document.querySelector("#registration_form")
    
    window.onload = function(){
        new_tickets();
        tickets_counter();
        system_users_counter();
        users();
    }

    document.querySelector("#username").addEventListener("focusout", ()=>{

        let loginForm = document.querySelector("#login-form");

        let value = document.querySelector("#username").value;

        let param = "check_username="+value;
        
        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/check_username.php', true);
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

    document.querySelector("#admin_username").addEventListener("focusout", ()=>{

        let loginForm = document.querySelector("#login-form");

        let value = document.querySelector("#admin_username").value;

        let param = "check_username="+value;
        
        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/check_username.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){
            if (this.status == 200) {

                let feedback = JSON.parse(this.responseText)
                
                if (feedback.response === true) {

                    document.querySelector("#admin_username").classList.remove("is-valid");
                    document.querySelector("#admin_username").classList.add("is-invalid");
                    
                }else{

                    document.querySelector("#admin_username").classList.remove("is-invalid");
                    document.querySelector("#admin_username").classList.add("is-valid");

                }
               
            }
        }

        xhr.send(param);
    });

    document.querySelector("#admin_confirm_password").addEventListener("focusout", ()=>{

        var password = document.querySelector("#admin_password").value;
        var confirm_password = document.querySelector("#admin_confirm_password").value;

        if (password != confirm_password) {
            
            document.querySelector("#admin_password").classList.add("is-invalid");
            document.querySelector("#admin_confirm_password").classList.add("is-invalid");

        }else{

            document.querySelector("#admin_password").classList.remove("is-invalid");
            document.querySelector("#admin_confirm_password").classList.remove("is-invalid");
            document.querySelector("#admin_password").classList.add("is-valid");
            document.querySelector("#admin_confirm_password").classList.add("is-valid");
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

    document.querySelector("#new_tickets").addEventListener("click", ()=>{

        document.querySelector("#table_container").innerText = "";
        new_tickets();

    });

    document.querySelector("#assigned_tickets").addEventListener("click", ()=>{

        document.querySelector("#table_container").innerText = "";
        assigned_tickets();

    });

    document.querySelector("#open_tickets").addEventListener("click", ()=>{

        document.querySelector("#table_container").innerText = "";
        open_tickets();

    });

    document.querySelector("#close_tickets").addEventListener("click", ()=>{

        document.querySelector("#table_container").innerText = "";
        close_tickets();

    });

    document.querySelector("#admins").addEventListener("click", ()=>{

        document.querySelector("#users_table_container").innerText = "";
        admins();

    });

    document.querySelector("#support_staff").addEventListener("click", ()=>{

        document.querySelector("#users_table_container").innerText = "";
        support_staff();

    });

    document.querySelector("#users").addEventListener("click", ()=>{

        document.querySelector("#users_table_container").innerText = "";
        users();

    });

    document.querySelector("#select_department").addEventListener("change", ()=>{

        let department_id = this.event.target.value;
        let params = "department_id="+department_id;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/get_assignees.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {

                let feedback = JSON.parse(this.responseText);

                document.querySelector("#select_assignee").innerHTML = "";
                let option = document.createElement("option");
                document.querySelector("#select_assignee").appendChild(option)

                for (let i in feedback) {
                    
                    let option = document.createElement("option");
                    option.setAttribute("value", feedback[i].id);
                    text = document.createTextNode(feedback[i].first_name+" "+feedback[i].surname);
                    option.appendChild(text);
                    document.querySelector("#select_assignee").appendChild(option)
                    
                }
                
            }
        }
        xhr.send(params);
    });

    document.querySelector("#submit_admin_form").addEventListener("click", ()=>{
        
        let form = document.querySelector("#admin_registration_form");

        let username = document.querySelector("#admin_username").value;
        let password = document.querySelector("#admin_password").value;
        let confirm = document.querySelector("#admin_confirm_password").value;
        let first_name = document.querySelector("#admin_first_name").value;
        let surname = document.querySelector("#admin_surname").value;
        let other_name = document.querySelector("#admin_other_name").value;
        let gender = document.querySelector("#admin_gender").value;
        let phone_number = document.querySelector("#admin_phone_number").value;
        let department = document.querySelector("#admin_select_department").value;
        let role = document.querySelector("#admin_select_role").value;

        if (username && password && confirm && first_name && surname && other_name && gender && phone_number && department && role) {
            
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "../scripts/submit_admin_registration_form.php", true);

            xhr.onload = function(){

                if (this.status == 200){
                        
                    if (this.responseText == "success") {
                            
                        document.querySelector("#submit_admin_close_btn").click();
                    }
                }
            }

            var data = new FormData(form);
            xhr.send(data);

            }
    });

    document.querySelector("#submit_ticket_btn").addEventListener("click", ()=>{submit_ticket()});

// function close_admin_modal(){
//     window.setTimeout(close_modal, 1000)
// }

// function close_modal(){
//     document.querySelector("#submit_admin_close_btn").click();
// }

function submit_form(){
    
    let xhr = new XMLHttpRequest();
        xhr.open("POST", "../scripts/submit_registration_form.php", true);

        xhr.onload = function(){

            if (this.status == 200) {
                    
                if (this.responseText == "success") {
                        
                    document.querySelector("#add_user_modal_close").click();
                }
            }
        }

        var data = new FormData(form);
        xhr.send(data);
}

function new_tickets(){

    let count = 0;
    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_ticket.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let tickets = JSON.parse(this.responseText);

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "14px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("User");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Title");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Description");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Date logged");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Category");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Priority");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_7 = document.createElement("th");
            th_7.setAttribute("scope","col");
            th_7_text = document.createTextNode("Action");
            th_7.appendChild(th_7_text)
            th_tr.appendChild(th_7);
            
            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in tickets) {

                
                if (tickets[i].status_description == "Awaiting Authorisation") {

                    count++
                    let code = "code";

                    let tr = document.createElement("tr");

                    let td_1 = document.createElement("td");
                    td_1_text = document.createTextNode(tickets[i].first_name+" "+tickets[i].surname);
                    td_1.appendChild(td_1_text);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(tickets[i].ticket_title);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(tickets[i].ticket_description);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(tickets[i].date_logged);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(tickets[i].category_description);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(tickets[i].priority_description);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_7 = document.createElement("td");
                    td_7.classList.add("action_btns");

                    let button_1 = document.createElement("button");

                    button_1.setAttribute("type", "button");
                    button_1.setAttribute("onclick", "assign_ticket()");
                    button_1.setAttribute("target", tickets[i].code);
                    button_1.classList.add("btn");
                    button_1.classList.add("btn-primary");
                    button_1.classList.add("btn-sm");

                    let i_1 = document.createElement("i");

                    i_1.setAttribute("target", tickets[i].code);
                    i_1.classList.add("far");
                    i_1.classList.add("fa-share-square");

                    button_1.appendChild(i_1);

                    let button_2 = document.createElement("button");

                    button_2.setAttribute("type", "button");
                    button_2.setAttribute("onclick", "delete_ticket()");
                    button_2.setAttribute("target", tickets[i].code);
                    button_2.classList.add("btn");
                    button_2.classList.add("btn-danger");
                    button_2.classList.add("btn-sm");

                    let i_2 = document.createElement("i");

                    i_2.setAttribute("target", tickets[i].code);
                    i_2.classList.add("far");
                    i_2.classList.add("fa-trash-alt");

                    button_2.appendChild(i_2)

                    let button_3 = document.createElement("button");

                    button_3.setAttribute("type", "button");
                    button_3.setAttribute("onclick", "edit_ticket()");
                    button_3.setAttribute("target", tickets[i].code);
                    button_3.classList.add("btn");
                    button_3.classList.add("btn-warning");
                    button_3.classList.add("btn-sm");

                    let i_3 = document.createElement("i");

                    i_3.setAttribute("target", tickets[i].code);
                    i_3.classList.add("far");
                    i_3.classList.add("fa-edit");

                    button_3.appendChild(i_3)

                    td_7.appendChild(button_1)
                    td_7.appendChild(button_3)
                    td_7.appendChild(button_2)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("tomato");
                    tr.appendChild(td_7);

                    tbody.appendChild(tr);

                }

            }

            table.appendChild(tbody);

            if (count > 0) {
                document.querySelector("#table_title").style.color = ("tomato");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-ticket-alt 5x"></i> New Tickets';
                document.querySelector("#table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#table_title").style.color = ("tomato");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-ticket-alt 5x"></i> New Tickets';
                document.querySelector("#table_container").appendChild(div);

            }
            
        }
    }
    xhr.send();
}

function assigned_tickets(){

    let count = 0;
    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_ticket.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let tickets = JSON.parse(this.responseText);

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "14px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("User");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Title");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Description");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Date logged");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Category");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Priority");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_7 = document.createElement("th");
            th_7.setAttribute("scope","col");
            th_7_text = document.createTextNode("Action");
            th_7.appendChild(th_7_text)
            th_tr.appendChild(th_7);
            
            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in tickets) {

                
                if (tickets[i].status_description == "Authorised") {

                    count++
                    let code = "code";

                    let tr = document.createElement("tr");

                    let td_1 = document.createElement("td");
                    td_1_text = document.createTextNode(tickets[i].first_name+" "+tickets[i].surname);
                    td_1.appendChild(td_1_text);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(tickets[i].ticket_title);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(tickets[i].ticket_description);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(tickets[i].date_logged);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(tickets[i].category_description);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(tickets[i].priority_description);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_7 = document.createElement("td");
                    td_7.classList.add("action_btns");

                    let button_1 = document.createElement("button");

                    button_1.setAttribute("type", "button");
                    button_1.setAttribute("onclick", "change_assignee()");
                    button_1.setAttribute("target", tickets[i].code);
                    button_1.classList.add("btn");
                    button_1.classList.add("btn-primary");
                    button_1.classList.add("btn-sm");

                    let i_1 = document.createElement("i");

                    i_1.setAttribute("target", tickets[i].code);
                    i_1.classList.add("far");
                    i_1.classList.add("fa-share-square");

                    button_1.appendChild(i_1);

                    let button_2 = document.createElement("button");

                    button_2.setAttribute("type", "button");
                    button_2.setAttribute("onclick", "delete_ticket()");
                    button_2.setAttribute("target", tickets[i].code);
                    button_2.classList.add("btn");
                    button_2.classList.add("btn-danger");
                    button_2.classList.add("btn-sm");

                    let i_2 = document.createElement("i");

                    i_2.setAttribute("target", tickets[i].code);
                    i_2.classList.add("far");
                    i_2.classList.add("fa-trash-alt");

                    button_2.appendChild(i_2)

                    td_7.appendChild(button_1)
                    td_7.appendChild(button_2)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("violet");
                    tr.appendChild(td_7);

                    tbody.appendChild(tr);

                }

            }

            table.appendChild(tbody);

            if (count > 0) {
                document.querySelector("#table_title").style.color = ("violet");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-clipboard-check"></i> Assigned Tickets';
                document.querySelector("#table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#table_title").style.color = ("orange");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-clipboard-check"></i> Open Tickets';
                document.querySelector("#table_container").appendChild(div);

            }
            
        }
    }
    xhr.send();
}

function open_tickets(){

    let count = 0;
    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_ticket.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let tickets = JSON.parse(this.responseText);

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "14px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("User");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Title");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Description");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Date logged");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Category");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Priority");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_7 = document.createElement("th");
            th_7.setAttribute("scope","col");
            th_7_text = document.createTextNode("Action");
            th_7.appendChild(th_7_text)
            th_tr.appendChild(th_7);
            
            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in tickets) {

                
                if (tickets[i].status_description == "In Progress") {
                    
                    count++
                    let code = "code";

                    let tr = document.createElement("tr");

                    let td_1 = document.createElement("td");
                    td_1_text = document.createTextNode(tickets[i].first_name+" "+tickets[i].surname);
                    td_1.appendChild(td_1_text);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(tickets[i].ticket_title);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(tickets[i].ticket_description);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(tickets[i].date_logged);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(tickets[i].category_description);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(tickets[i].priority_description);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_7 = document.createElement("td");
                    td_7.classList.add("action_btns");

                    let button_1 = document.createElement("button");

                    button_1.setAttribute("type", "button");
                    button_1.setAttribute("onclick", "change_assignee()");
                    button_1.setAttribute("target", tickets[i].code);
                    button_1.classList.add("btn");
                    button_1.classList.add("btn-success");
                    button_1.classList.add("btn-sm");

                    let i_1 = document.createElement("i");

                    i_1.setAttribute("target", tickets[i].code);
                    i_1.classList.add("far");
                    i_1.classList.add("fa-share-square");

                    button_1.appendChild(i_1);

                    let button_2 = document.createElement("button");

                    button_2.setAttribute("type", "button");
                    button_2.setAttribute("onclick", "close_ticket()");
                    button_2.setAttribute("target", tickets[i].code);
                    button_2.classList.add("btn");
                    button_2.classList.add("btn-info");
                    button_2.classList.add("btn-sm");

                    let i_2 = document.createElement("i");

                    i_2.setAttribute("target", tickets[i].code);
                    i_2.classList.add("fas");
                    i_2.classList.add("fa-times");

                    button_2.appendChild(i_2)

                    let button_3 = document.createElement("button");

                    button_3.setAttribute("type", "button");
                    button_3.setAttribute("onclick", "view_ticket()");
                    button_3.setAttribute("target", tickets[i].code);
                    button_3.classList.add("btn");
                    button_3.classList.add("btn-secondary");
                    button_3.classList.add("btn-sm");

                    let i_3 = document.createElement("i");

                    i_3.setAttribute("target", tickets[i].code);
                    i_3.classList.add("far");
                    i_3.classList.add("fa-eye");

                    button_3.appendChild(i_3)

                    td_7.appendChild(button_1)
                    td_7.appendChild(button_3)
                    td_7.appendChild(button_2)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("orange");
                    tr.appendChild(td_7);

                    tbody.appendChild(tr);

                }

            }

            table.appendChild(tbody);

            if (count > 0) {
                document.querySelector("#table_title").style.color = ("orange");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-envelope-open-text"></i> Open Tickets';
                document.querySelector("#table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#table_title").style.color = ("orange");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-envelope-open-text"></i> Open Tickets';
                document.querySelector("#table_container").appendChild(div);

            }
            
        }
    }
    xhr.send();
}

function close_tickets(){

    let count = 0;
    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_ticket.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let tickets = JSON.parse(this.responseText);

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "14px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("User");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Type");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Category");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Title");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Description");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Date Logged");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_7 = document.createElement("th");
            th_7.setAttribute("scope","col");
            th_7_text = document.createTextNode("Date Closed");
            th_7.appendChild(th_7_text);
            th_tr.appendChild(th_7);

            // let th_7 = document.createElement("th");
            // th_7.setAttribute("scope","col");
            // th_7_text = document.createTextNode("Action");
            // th_7.appendChild(th_7_text)
            // th_tr.appendChild(th_7);
            
            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in tickets) {

                
                if (tickets[i].status_description == "Complete" || tickets[i].status_description == "Awaiting Closure") {

                    count++
                    let code = "code";

                    let tr = document.createElement("tr");

                    let td_1 = document.createElement("td");
                    td_1_text = document.createTextNode(tickets[i].first_name+" "+tickets[i].surname);
                    td_1.appendChild(td_1_text);
                    tr.appendChild(td_1);

                    let td_2 = document.createElement("td");
                    td_2_text = document.createTextNode(tickets[i].type_description);
                    td_2.appendChild(td_2_text);
                    tr.appendChild(td_2);

                    let td_3 = document.createElement("td");
                    td_3_text = document.createTextNode(tickets[i].category_description);
                    td_3.appendChild(td_3_text);
                    tr.appendChild(td_3);

                    let td_4 = document.createElement("td");
                    td_4_text = document.createTextNode(tickets[i].ticket_title);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(tickets[i].ticket_description);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(tickets[i].date_logged);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_7 = document.createElement("td");
                    td_7_text = document.createTextNode(tickets[i].date_closed);
                    td_7.appendChild(td_7_text);
                    tr.appendChild(td_7);

                    // let td_7 = document.createElement("td");
                    // td_7.classList.add("action_btns");

                    // let button_1 = document.createElement("button");

                    // button_1.setAttribute("type", "button");
                    // button_1.setAttribute("onclick", "assign_ticket()");
                    // button_1.setAttribute("target", tickets[i].code);
                    // button_1.classList.add("btn");
                    // button_1.classList.add("btn-primary");
                    // button_1.classList.add("btn-sm");

                    // let i_1 = document.createElement("i");

                    // i_1.setAttribute("target", tickets[i].code);
                    // i_1.classList.add("far");
                    // i_1.classList.add("fa-share-square");

                    // button_1.appendChild(i_1);

                    // let button_2 = document.createElement("button");

                    // button_2.setAttribute("type", "button");
                    // button_2.setAttribute("onclick", "delete_ticket()");
                    // button_2.setAttribute("target", tickets[i].code);
                    // button_2.classList.add("btn");
                    // button_2.classList.add("btn-danger");
                    // button_2.classList.add("btn-sm");

                    // let i_2 = document.createElement("i");

                    // i_2.setAttribute("target", tickets[i].code);
                    // i_2.classList.add("far");
                    // i_2.classList.add("fa-trash-alt");

                    // button_2.appendChild(i_2)

                    // let button_3 = document.createElement("button");

                    // button_3.setAttribute("type", "button");
                    // button_3.setAttribute("onclick", "edit_ticket()");
                    // button_3.setAttribute("target", tickets[i].code);
                    // button_3.classList.add("btn");
                    // button_3.classList.add("btn-warning");
                    // button_3.classList.add("btn-sm");

                    // let i_3 = document.createElement("i");

                    // i_3.setAttribute("target", tickets[i].code);
                    // i_3.classList.add("far");
                    // i_3.classList.add("fa-edit");

                    // button_3.appendChild(i_3)

                    // td_7.appendChild(button_1)
                    // td_7.appendChild(button_3)
                    // td_7.appendChild(button_2)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("mediumseagreen");
                    //tr.appendChild(td_7);

                    tbody.appendChild(tr);

                }

            }

            table.appendChild(tbody);

            if (count > 0) {
                document.querySelector("#table_title").style.color = ("mediumseagreen");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-envelope"></i> Close Tickets';
                document.querySelector("#table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#table_title").style.color = ("mediumseagreen");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-envelope"></i> Close Tickets';
                document.querySelector("#table_container").appendChild(div);

            }
            
        }
    }
    xhr.send();
}

function submit_ticket(){
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../scripts/submit_ticket.php", true);

    xhr.onload = function(){

        if (this.status == 200) {

            console.log(this.responseText);

            if (this.responseText == "submitted") {
                
                document.querySelector("#table_container").innerText="";
                new_tickets();
                document.querySelector("#close_edit_modal").click();
            }
            
        }
    }
    
    var data = new FormData(ticket_form);
    xhr.send(data);
}

function assign_ticket(){

    let code = this.event.target.getAttribute("target");

    document.querySelector("#select_department").value = "";
    document.querySelector("#select_assignee").innerHTML = "";
    document.querySelector("#assign_ticket_btn").click();
    document.querySelector("#assign_ticket_input").value = code;
    document.querySelector("#assign_ticket_code").innerText = code;
    document.querySelector("#assign_ticket").setAttribute("target", code);

}

function assign(){

    //let code = this.event.target.getAttribute("target");
    let code = document.querySelector("#assign_ticket_code").innerText;
    let assignee_id = document.querySelector("#select_assignee").value;

    let params = "code="+code+"&assignee_id="+assignee_id;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/assign_ticket.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {
                
                if (this.responseText == "assigned") {
                    document.querySelector("#table_container").innerHTML = "";
                    document.querySelector("#assign_modal_close").click();
                    document.querySelector("#select_department").value = "";
                    document.querySelector("#select_assignee").innerHTML = "";
                    new_tickets();
                }
            }
        }
        xhr.send(params);

}

function delete_ticket(){

    let code = this.event.target.getAttribute("target");

    document.querySelector("#delete_ticket_btn").click();
    document.querySelector("#delete_ticket_input").value = code;
    document.querySelector("#delete_ticket_code").innerText = code;
    document.querySelector("#delete_ticket").setAttribute("target", code);
}

function delete_(){

    //let code = this.event.target.getAttribute("target");
    let code = document.querySelector("#delete_ticket_code").innerText;

    let params = "code="+code;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/delete_ticket.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {
                
                document.querySelector("#table_container").innerHTML = "";
                new_tickets();
                tickets_counter()
                document.querySelector("#delete_modal_close").click();
            }
        }
        xhr.send(params);
}

function edit_ticket(){
    let code = this.event.target.getAttribute("target");

    let params = "code="+code;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/get_ticket.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){
        if (this.status == 200) {

            let ticket = JSON.parse(this.responseText);
            
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

function tickets_counter(){

    let new_tickets = 0;
    let open_tickets = 0;
    let close_tickets = 0;
    let assigned_tickets = 0;

    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_ticket.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            document.querySelector("#new_tickets_counter").innerText = "";
            document.querySelector("#open_tickets_count").innerText = "";
            document.querySelector("#close_tickets_counter").innerText = "";

            let tickets = JSON.parse(this.responseText);

            for (let i in tickets) {

                if (tickets[i].status_description == "Awaiting Authorisation") {
                    new_tickets++
                }
                if (tickets[i].status_description == "Authorised") {
                    assigned_tickets++
                }
                if (tickets[i].status_description == "In Progress") {
                    open_tickets++
                }
                if (tickets[i].status_description == "Complete" || tickets[i].status_description == "Awaiting Closure") {
                    close_tickets++
                }
            }
            
            document.querySelector("#new_tickets_counter").innerText = new_tickets;
            document.querySelector("#assigned_tickets_count").innerText = assigned_tickets;
            document.querySelector("#open_tickets_count").innerText = open_tickets;
            document.querySelector("#close_tickets_counter").innerText = close_tickets;
            
        }
    }
    xhr.send();
}

function system_users_counter(){

    let admins = 0;
    let support_staff = 0;
    let users = 0;

    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_system_users.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            document.querySelector("#admins_counter").innerText = "";
            document.querySelector("#support_staff_counter").innerText = "";
            document.querySelector("#users_counter").innerText = "";

            let system_users = JSON.parse(this.responseText);

            for (let i in system_users) {

                if (system_users[i].account_type == "admin") {
                    admins++
                }
                if (system_users[i].account_type == "support") {
                    support_staff++
                }
                if (system_users[i].account_type == "user") {
                    users++
                }
            }
            
            document.querySelector("#admins_counter").innerText = admins;
            document.querySelector("#support_staff_counter").innerText = support_staff;
            document.querySelector("#users_counter").innerText = users;
            
        }
    }
    xhr.send();
} 

function admins(){

    let count = 0;

    let xhr = new XMLHttpRequest();

    xhr.open('GET', '../scripts/get_system_administrators.php', true);

    xhr.onload = function(){

        if (this.status == 200) {

            let system_users = JSON.parse(this.responseText);

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "14px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.style.width = "7%";
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("Picture");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Name");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Username");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Phone_number");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Role");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.style.width = "10%";
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Action");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in system_users) {

                if (system_users[i].account_type == "admin") {

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

                    tbody.appendChild(tr);

                }
            }

            table.appendChild(tbody);

            if (count > 0) {
                document.querySelector("#users_table_title").style.color = ("dodgerblue");
                document.querySelector("#users_table_title").innerHTML = '<i class="fas fa-users-cog"></i> Admins';
                document.querySelector("#users_table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#users_table_title").style.color = ("dodgerblue");
                document.querySelector("#users_table_title").innerHTML = '<i class="fas fa-envelope"></i> Close Tickets';
                document.querySelector("#users_table_container").appendChild(div);

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

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "14px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.style.width = "7%";
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("Picture");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Name");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Username");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Depaartment");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Phone Number");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.style.width = "10%";
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Role");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_7 = document.createElement("th");
            th_7.style.width = "10%";
            th_7.setAttribute("scope","col");
            th_7_text = document.createTextNode("Action");
            th_7.appendChild(th_7_text);
            th_tr.appendChild(th_7);

            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in system_users) {

                if (system_users[i].account_type == "support") {

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

                    tbody.appendChild(tr);

                }
            }

            table.appendChild(tbody);
            document.querySelector("#users_table_container").appendChild(table);
            if (count > 0) {
                document.querySelector("#users_table_title").style.color = ("grey");
                document.querySelector("#users_table_title").innerHTML = '<i class="fas fa-cogs"></i> Support Staff';
                document.querySelector("#users_table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#users_table_title").style.color = ("grey");
                document.querySelector("#users_table_title").innerHTML = '<i class="fas fa-cogs"></i> Close Tickets';
                document.querySelector("#users_table_container").appendChild(div);

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

            let table = document.createElement("table");

            table.classList.add("table");
            table.classList.add("table-sm");
            table.classList.add("mt-3");
            table.classList.add("mb-2");
            table.style.fontSize = "14px";

            let thead = document.createElement("thead");

            let tbody = document.createElement("tbody");

            let th_tr = document.createElement("tr");
            
            let th_1 = document.createElement("th");
            th_1.style.width = "7%";
            th_1.setAttribute("scope","col");
            th_1_text = document.createTextNode("Picture");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);

            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Name");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Username");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Phone_number");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Email");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.style.width = "10%";
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Action");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            thead.appendChild(th_tr);

            table.appendChild(thead);

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

                    tbody.appendChild(tr);

                }
            }

            table.appendChild(tbody);
            
            if (count > 0) {
                document.querySelector("#users_table_title").style.color = ("slateblue");
                document.querySelector("#users_table_title").innerHTML = '<i class="fas fa-users"></i> Users';
                document.querySelector("#users_table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");

                document.querySelector("#users_table_title").style.color = ("slateblue");
                document.querySelector("#users_table_title").innerHTML = '<i class="fas fa-envelope"></i> Users';
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

function change_assignee(){

    document.querySelector("#select_department").value = "";
    document.querySelector("#select_assignee").innerHTML = "";
    document.querySelector("#assign_ticket_btn").click();

}

function view_ticket(){

    let code = this.event.target.getAttribute("target")

    document.querySelector("#view_ticket_code").innerText = code;
    document.querySelector("#view_ticket").click();
}

function view_(){

    let code = document.querySelector("#view_ticket_code").innerText;

    console.log("tada "+code);
}

function close_ticket(){

    let code = this.event.target.getAttribute("target");

    document.querySelector("#close_ticket_code").innerText = code;
    document.querySelector("#close_ticket").click();
}

function close_(){

    let code = document.querySelector("#close_ticket_code").innerText;
    
    let params = "code="+code;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/close_ticket.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {
                
                if (this.responseText == "closed") {

                    document.querySelector("#table_container").innerHTML = "";
                    document.querySelector("#close_modal_close").click();
                    tickets_counter()
                    open_tickets();
                    
                }else{
                    console.log(this.responseText)
                }
            }
        }
        xhr.send(params);
}
   

</script>
</html>