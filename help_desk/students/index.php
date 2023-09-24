<?php
    session_start();

    include 'scripts/class_auto_loader.php';


    if (!$_SESSION["user_id"] || $_SESSION["account_type"] != "user") {
    header("location:../login.php");
    die();
    }

    $id = $_SESSION["user_id"];

    $controler = new Controler();

    $problem_categories = $controler->problem_categories();
    $ticket_priorities = $controler->ticket_priorities();
    $ticket_type = $controler->ticket_type();

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
    <button id="raise_ticket" data-bs-toggle="modal" data-bs-target="#add_ticket" hidden>raise ticket</button>
    <button id="support_modal_btn" data-bs-toggle="modal" data-bs-target="#support_modal" hidden>open ticket</button>
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
                <li class="nav-item">
                <a class="nav-link add_ticket" href="#" onclick="raise_ticket()"><i class="fas fa-plus"></i> Raise Tickets</a>
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

    <div class="container">
        <div class="card mt-4 mb-4">
            <div class="card-body">
                <h2 class="mb-4" style="color: grey;"><i class="fas fa-tachometer-alt"></i> Dashboard</h2>
                <hr class="divider">
                <div class="row justify-content-evenly">
                    <div id="new_tickets" class="card col-md-2 border-light pointer" style="background-color: mediumseagreen; color:whitesmoke;">
                        <div class="card-body">
                            <h6>New Tickets</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="new_tickets_counter"></h3>
                                <h3><i class="fas fa-ticket-alt 5x"></i></h3>
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
                    <div id="close_tickets" class="card col-md-2 border-light pointer" style="background-color: tomato; color:whitesmoke;">
                        <div class="card-body">
                            <h6>Closed Ticket</h6>
                            <span style="display: flex; justify-content: space-between;">
                                <h3 id="close_tickets_counter"></h3>
                                <h3><i class="fas fa-envelope"></i></i></h3>
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

    <nav class="navbar fixed-bottom navbar-dark">
        <div class="container justify-content-center">
            <span style="color: white;">Copyright @2021 Al-Qalam University Katsina</span>
        </div>
    </nav>

    <?php include '../includes/modals.php';?>
</body>
<script src="../js/bootstrap.min.js"></script>
<script>
    
document.querySelector("#add_file_btn").addEventListener("click", ()=>{ticket_file.click()});
document.querySelector("#submit_ticket_btn").addEventListener("click", ()=>{submit_ticket()});

var id = <?=$id?>;
let uploaded_files = [];

window.onload = function(){

    var id = <?=$id?>;
        
    user_new_tickets(id);

    tickets_counter(id)
}

document.querySelector("#new_tickets").addEventListener("click", ()=>{

    document.querySelector("#table_container").innerText = "";
    user_new_tickets(id);

});

document.querySelector("#open_tickets").addEventListener("click", ()=>{

    document.querySelector("#table_container").innerText = "";
    user_open_tickets(id);

});

document.querySelector("#close_tickets").addEventListener("click", ()=>{

    document.querySelector("#table_container").innerText = "";
    user_close_tickets(id);

});

function tickets_counter(id){

    document.querySelector("#new_tickets_counter").innerText = "";
    document.querySelector("#open_tickets_count").innerText = "";
    document.querySelector("#close_tickets_counter").innerText = "";

    let params = "id="+id;

    let new_tickets = 0;
    let open_tickets = 0;
    let close_tickets = 0;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/get_user_tickets.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){

        if (this.status == 200) {

            let tickets = JSON.parse(this.responseText);

            for (let i in tickets) {

                if (tickets[i].status_description == "Awaiting Authorisation") {
                    new_tickets++
                }
                if (tickets[i].status_description == "Authorised" || tickets[i].status_description == "In Progress") {
                    open_tickets++
                }
                if (tickets[i].status_description == "Complete" || tickets[i].status_description == "Awaiting Closure") {
                    close_tickets++
                }
            }
            
            document.querySelector("#new_tickets_counter").innerText = new_tickets;
            document.querySelector("#open_tickets_count").innerText = open_tickets;
            document.querySelector("#close_tickets_counter").innerText = close_tickets;
            
        }
    }
    xhr.send(params);
}

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

function user_new_tickets(id){
    
    let count = 0;
    let params = "id="+id;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/get_user_tickets.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

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
            th_1_text = document.createTextNode("Code");
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
            th_4_text = document.createTextNode("Category");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Priority");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Date logged");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_7 = document.createElement("th");
            th_7.setAttribute("scope","col");
            th_7.classList.add("text-center");
            th_7_text = document.createTextNode("Action");
            th_7.appendChild(th_7_text)
            th_tr.appendChild(th_7);
            
            thead.appendChild(th_tr);

            table.appendChild(thead);

            for (let i in tickets) {

                
                if (tickets[i].status_description == "Awaiting Authorisation" || tickets[i].status_description == "Authorised") {

                    count++
                    let code = "code";

                    let tr = document.createElement("tr");

                    let td_1 = document.createElement("td");
                    td_1_text = document.createTextNode(tickets[i].code);
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
                    td_4_text = document.createTextNode(tickets[i].category_description);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(tickets[i].priority_description);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(tickets[i].date_logged);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_7 = document.createElement("td");
                    td_7.classList.add("action_btns");

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

                    td_7.appendChild(button_3)
                    td_7.appendChild(button_2)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("mediumseagreen");
                    tr.appendChild(td_7);

                    tbody.appendChild(tr);

                }

            }
            
            table.appendChild(tbody);

            if (count > 0) {
                document.querySelector("#table_title").style.color = ("mediumseagreen");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-ticket-alt 5x"></i> New Tickets';
                document.querySelector("#table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");
                document.querySelector("#table_container").appendChild(div);

            }
            
            
        }
    }
    xhr.send(params);
}

function user_open_tickets(id){
    
    let count = 0;
    let params = "id="+id;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/get_user_tickets.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

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
            th_1_text = document.createTextNode("Code");
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
            th_4_text = document.createTextNode("Category");
            th_4.appendChild(th_4_text);
            th_tr.appendChild(th_4);

            let th_5 = document.createElement("th");
            th_5.setAttribute("scope","col");
            th_5_text = document.createTextNode("Priority");
            th_5.appendChild(th_5_text);
            th_tr.appendChild(th_5);

            let th_6 = document.createElement("th");
            th_6.setAttribute("scope","col");
            th_6_text = document.createTextNode("Date logged");
            th_6.appendChild(th_6_text);
            th_tr.appendChild(th_6);

            let th_8 = document.createElement("th");
            th_8.setAttribute("scope","col");
            th_8_text = document.createTextNode("Date Assigned");
            th_8.appendChild(th_8_text);
            th_tr.appendChild(th_8);

            let th_7 = document.createElement("th");
            th_7.setAttribute("scope","col");
            th_7.classList.add("text-center");
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
                    td_1_text = document.createTextNode(tickets[i].code);
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
                    td_4_text = document.createTextNode(tickets[i].category_description);
                    td_4.appendChild(td_4_text);
                    tr.appendChild(td_4);

                    let td_5 = document.createElement("td");
                    td_5_text = document.createTextNode(tickets[i].priority_description);
                    td_5.appendChild(td_5_text);
                    tr.appendChild(td_5);

                    let td_6 = document.createElement("td");
                    td_6_text = document.createTextNode(tickets[i].date_logged);
                    td_6.appendChild(td_6_text);
                    tr.appendChild(td_6);

                    let td_8 = document.createElement("td");
                    td_8_text = document.createTextNode(tickets[i].date_assigned);
                    td_8.appendChild(td_8_text);
                    tr.appendChild(td_8);

                    let td_7 = document.createElement("td");
                    td_7.classList.add("action_btns");

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
                    button_3.setAttribute("onclick", "ticket_chat()");
                    button_3.setAttribute("target", tickets[i].code);
                    button_3.classList.add("btn");
                    button_3.classList.add("btn-light");
                    button_3.classList.add("btn-sm");

                    let i_3 = document.createElement("i");

                    i_3.setAttribute("target", tickets[i].code);
                    i_3.classList.add("far");
                    i_3.classList.add("fa-comments");

                    button_3.appendChild(i_3)

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
                document.querySelector("#table_container").appendChild(div);

            }
            
        }
    }
    xhr.send(params);
}

function user_close_tickets(id){
    
    let count = 0;
    let params = "id="+id;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/get_user_tickets.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

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
            th_1_text = document.createTextNode("Code");
            th_1.appendChild(th_1_text);
            th_tr.appendChild(th_1);
            
            let th_2 = document.createElement("th");
            th_2.setAttribute("scope","col");
            th_2_text = document.createTextNode("Type");
            th_2.appendChild(th_2_text);
            th_tr.appendChild(th_2);

            let th_3 = document.createElement("th");
            th_3.setAttribute("scope","col");
            th_3_text = document.createTextNode("Title");
            th_3.appendChild(th_3_text);
            th_tr.appendChild(th_3);

            let th_4 = document.createElement("th");
            th_4.setAttribute("scope","col");
            th_4_text = document.createTextNode("Description");
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
            th_7_text = document.createTextNode("Date logged");
            th_7.appendChild(th_7_text);
            th_tr.appendChild(th_7);

            let th_8 = document.createElement("th");
            th_8.setAttribute("scope","col");
            th_8_text = document.createTextNode("Date Closed");
            th_8.appendChild(th_8_text);
            th_tr.appendChild(th_8);

            // let th_7 = document.createElement("th");
            // th_7.setAttribute("scope","col");
            // th_7.classList.add("text-center");
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
                    td_1_text = document.createTextNode(tickets[i].code);
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
                    td_7_text = document.createTextNode(tickets[i].date_logged);
                    td_7.appendChild(td_7_text);
                    tr.appendChild(td_7);

                    let td_8 = document.createElement("td");
                    td_8_text = document.createTextNode(tickets[i].date_closed);
                    td_8.appendChild(td_8_text);
                    tr.appendChild(td_8);

                    // let td_7 = document.createElement("td");
                    // td_7.classList.add("action_btns");

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

                    // td_7.appendChild(button_3)
                    // td_7.appendChild(button_2)

                    tr.style.borderWidth = ("0px 0px 0px 4px");
                    tr.style.borderColor = ("tomato");
                    //tr.appendChild(td_7);

                    tbody.appendChild(tr);

                }

            }
            
            table.appendChild(tbody);

            if (count > 0) {
                document.querySelector("#table_title").style.color = ("tomato");
                document.querySelector("#table_title").innerHTML = '<i class="fas fa-envelope"></i> Close Tickets';
                document.querySelector("#table_container").appendChild(table);
            }else{

                let div = document.createElement("h3");
                div.classList.add("text-center");
                div.innerText = ("No record found");
                document.querySelector("#table_container").appendChild(div);

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

    let id =  <?=$id?>;

    let code = document.querySelector("#delete_ticket_code").innerText;

    let params = "code="+code;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/delete_ticket.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){

        if (this.status == 200) {

            tickets_counter(id)
            document.querySelector("#table_container").innerText = "";
            user_new_tickets(id);
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

function clear_support_modal(){

    document.querySelector("#support_modal_body").innerHTML = "";
    document.querySelector("#support_model_ticket_btn").removeAttribute("onclick")
    document.querySelector("#support_model_ticket_btn").innerHTML = "";

}

function close_ticket(){

    clear_support_modal();
    let code = this.event.target.getAttribute("target");

    document.querySelector("#support_modal_title").innerText = "Close Tcket";

    let h4 = document.createElement("h4");
    h4.classList.add("text-center");
    h4.setAttribute("id", "support_model_code")
    let h4_text = document.createTextNode(code);
    h4.appendChild(h4_text)

    let h5 = document.createElement("h5");
    h5.classList.add("text-center");
    let h5_text = document.createTextNode("Colse this ticket?");
    h5.appendChild(h5_text)

    let body = document.querySelector("#support_modal_body");

    body.appendChild(h4);
    body.appendChild(h5);

    let btn = document.querySelector("#support_model_ticket_btn")
    btn.classList.add("btn-info")
    btn.setAttribute("onclick", "close_()")
    btn.innerHTML = '<i class="far fa-times">&ensp;</i> Close';

    document.querySelector("#support_modal_btn").click();
}

function close_(){

    let code = document.querySelector("#support_model_code").innerText;
    
    let params = "code="+code;

        let xhr = new XMLHttpRequest();

        xhr.open('POST', '../scripts/close_ticket.php', true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onload = function(){

            if (this.status == 200) {
                
                if (this.responseText == "closed") {

                    document.querySelector("#table_container").innerHTML = "";
                    document.querySelector("#support_modal_close").click();

                    clear_support_modal();
                    tickets_counter(id);
                    user_open_tickets(id);
                    
                }else{
                    console.log(this.responseText)
                }
            }
        }
        xhr.send(params);
}

function ticket_chat(){

    clear_support_modal();
    let code = this.event.target.getAttribute("target");

    let params = "code="+code;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/get_ticket.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){

        if (this.status == 200) {
            
            ticket = JSON.parse(this.responseText);

            document.querySelector("#support_modal_title").innerText = "Ticket Chat";

            let h4 = document.createElement("h4");
            h4.classList.add("text-center");
            h4.setAttribute("id", "support_model_code")
            let h4_text = document.createTextNode(code);
            h4.appendChild(h4_text)

            let title_container = document.createElement("div");
            title_container.classList.add("row");
            let label = document.createElement("strong");
            label.classList.add("d-flex")
            label.classList.add("justify-content-end")
            label.classList.add("col-3")
            let label_text = document.createTextNode("Title: ");
            label.appendChild(label_text)
            let title_content = document.createElement("div");
            title_content.classList.add("col-8")
            let title_text = document.createTextNode(ticket.ticket_title);
            title_content.appendChild(title_text)
            title_container.appendChild(label)
            title_container.appendChild(title_content)

            let description_container = document.createElement("div");
            description_container.classList.add("row");
            let description_label = document.createElement("strong");
            description_label.classList.add("d-flex")
            description_label.classList.add("justify-content-end")
            description_label.classList.add("col-3")
            let description_label_text = document.createTextNode("Description: ");
            description_label.appendChild(description_label_text)
            let description_content = document.createElement("div");
            description_content.classList.add("col-8")
            let description_text = document.createTextNode(ticket.ticket_description);
            description_content.appendChild(description_text)
            description_container.appendChild(description_label)
            description_container.appendChild(description_content)

            let chat_container = document.createElement("div");
            chat_container.classList.add("conatainer");
            chat_container.setAttribute("id", code)
            chat_container.classList.add("uploaded_files_container");
            chat_container.style.maxHeight = "300px";
            // chat_container.style.overflowY = "scroll"

            let text_area = document.createElement("textarea");
            text_area.classList.add("form-control");
            text_area.classList.add("form-control-sm");
            text_area.setAttribute("rows", "2");
            text_area.setAttribute("id", "chat_text_area");

            let text_area_div = document.createElement("div");
            text_area_div.classList.add("col-10")
            text_area_div.classList.add("mb-2")
            text_area_div.classList.add("d-flex")
            text_area_div.classList.add("justify-content-center")
            text_area_div.appendChild(text_area)

            let button_1 = document.createElement("button");
            button_1.setAttribute("type", "button");
            button_1.setAttribute("onclick", "send_msg()");
            button_1.setAttribute("target", ticket.code);
            button_1.classList.add("btn");
            button_1.classList.add("btn-primary");
            button_1.classList.add("btn-sm");
            button_1.classList.add("col-1");

            let i_1 = document.createElement("i");

            i_1.setAttribute("target", ticket.code);
            i_1.classList.add("far");
            i_1.classList.add("fa-share-square");

            button_1.appendChild(i_1);

            text_area_container = document.createElement("div")
            text_area_container.classList.add("row");

            text_area_container.appendChild(text_area_div)
            text_area_container.appendChild(button_1)
            
            let divider_1 = document.createElement("hr");
            divider_1.classList.add("divider");
            let divider_2 = document.createElement("hr");
            divider_2.classList.add("divider");
            let divider_3 = document.createElement("hr");
            divider_3.classList.add("divider");

            let body = document.querySelector("#support_modal_body");

            body.appendChild(h4);
            body.appendChild(divider_1);
            body.appendChild(title_container);
            body.appendChild(description_container);
            body.appendChild(divider_2);
            body.appendChild(chat_container);
            body.appendChild(divider_3);
            body.appendChild(text_area_container);

            chat_(code);

            document.querySelector("#support_modal_btn").click();
        }
    }
     xhr.send(params);
    
}

function chat_(code){
    
    let container = document.querySelector("#"+code);

    let params = "code="+code;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/fetch_chat.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){

        if (this.status == 200) {
            
            let msgs = JSON.parse(this.responseText);

            for (let i in msgs) {

                if (msgs[i].responded_by != 0) {

                    let bobble = document.createElement("div");
                    bobble.classList.add("d-flex")
                    bobble.classList.add("justify-content-start");
                    bobble.classList.add("mb-2");

                    let msg_container = document.createElement("div");
                    msg_container.style.maxWidth = "60%";
                    msg_container.style.backgroundColor = "#f8e5de";
                    msg_container.style.padding = "10px";
                    msg_container.style.borderRadius = "10px";

                    let msg = document.createTextNode(msgs[i].action_details);
                    
                    msg_container.appendChild(msg);
                    bobble.appendChild(msg_container);
                    container.appendChild(bobble);

                }else{
                    
                    let bobble = document.createElement("div");
                    bobble.classList.add("d-flex")
                    bobble.classList.add("justify-content-end");
                    bobble.classList.add("mb-2");
                    bobble.classList.add("px-2");

                    let msg_container = document.createElement("div");
                    msg_container.style.backgroundColor = "lightgrey";
                    msg_container.style.padding = "10px";
                    msg_container.style.borderRadius = "10px";

                    let msg = document.createTextNode(msgs[i].action_details);
                    
                    msg_container.appendChild(msg);
                    bobble.appendChild(msg_container);
                    container.appendChild(bobble);

                }
                
            }
            
        }
    }
     xhr.send(params);
}

function send_msg(){

    let code = this.event.target.getAttribute("target");
    let id = 0;
    let msg = document.querySelector("#chat_text_area").value
    
    let params = "code="+code+"&msg="+msg+"&id="+id;

    let xhr = new XMLHttpRequest();

    xhr.open('POST', '../scripts/send_msg.php', true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = function(){

        if (this.status == 200) {
            document.querySelector("#"+code).innerHTML = "";
            document.querySelector("#chat_text_area").value = "";
            chat_(code);
            document.querySelector("#"+code).scrollHeight;
            console.log(this.responseText)
        }
    }
     xhr.send(params);
}



</script>
</html>