<?php session_start();

include 'class_auto_loader.php';

$complainant_id = $_SESSION["user_id"];

$controler = new Controler();

if (!empty($_POST["title"]) && !empty($_POST["description"])) {

    $ticket_code = $_POST["ticket_code"];
    $problem_category = $_POST["problem_category"];
    $ticket_priority = $_POST["ticket_priority"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $ticket_type = $_POST["ticket_type"];

    if (empty($ticket_code)) {
        $controler->submit_ticket($problem_category, $ticket_priority, $title, $description, $complainant_id, $ticket_type);
    }else {
        $controler->update_ticket($ticket_code, $title, $description, $problem_category, $ticket_priority, $ticket_type);
    }

}