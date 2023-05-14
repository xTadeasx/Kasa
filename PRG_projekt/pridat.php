<?php
session_start();
$databaze = @$_SESSION["name"] or "";
$username = @$_SESSION["username"] or "";
$password = @$_SESSION["password"] or "";
$vypnit = @$_SESSION["vypnit"] or "";
if ($databaze == ""){
        $databaze = "kasa_main";
    }
function insert ($name, $price, $databaze) {
$conn = new mysqli("localhost", "root", "", "$databaze");
$sql = "INSERT INTO koupit (Nazev, Cena)
        VALUES ('$name', '$price')";
$conn->query($sql);
header("location: index.php");
}
insert($_POST["nazev"], $_POST["cena"], $databaze);
?>