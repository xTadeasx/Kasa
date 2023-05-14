<?php
session_start();
$username = ucfirst($_POST["username"]);
$password = ucfirst($_POST["password"]);


$conn = new mysqli("localhost", "root", "", "uzivatele");

$sql = "select * from uzivatel where username = '$username' and password = '$password'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count == 1){
    $_SESSION["name"] = $row["email"];
    $_SESSION["username"] = $row["username"];
    $_SESSION["password"] = $row["password"];
    header("Location: http://localhost/Projekty/PRG_projekt/index.php");
}else {
    header("Location: http://localhost/Projekty/PRG_projekt/registace/registrace.php");
}

?>