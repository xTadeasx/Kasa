<?php
session_start();
function test_input($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return ucfirst($data);
}
$_SESSION["name"] = test_input($_POST["name"]);
$_SESSION["surname"] = test_input($_POST["surname"]);
$_SESSION["username"] = test_input($_POST["username"]);
$_SESSION["password"] = test_input($_POST["password"]);
$_SESSION["vypnit"] = "vyplňtě všechny údaje prosím";
header('Location: registrace.php');
?>