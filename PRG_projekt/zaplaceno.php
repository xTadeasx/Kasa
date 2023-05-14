<?php
session_start();
$databaze = @$_SESSION["name"] or "";
$username = @$_SESSION["username"] or "";
$password = @$_SESSION["password"] or "";
$vypnit = @$_SESSION["vypnit"] or "";
if ($databaze == ""){
    $databaze = "kasa_main";
}

$conn = new mysqli("localhost", "root", "", "$databaze");
$sql = "TRUNCATE TABLE koupit";
$conn->query($sql);
header("location: index.php");
?>