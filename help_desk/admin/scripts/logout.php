<?php
session_start();

unset($_SESSION["d"]);
unset($_SESSION["user_id"]);
unset($_SESSION["username"]);
unset($_SESSION["account_type"]);

header("Location:../login.php");
?>