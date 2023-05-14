<?php
session_start();
$databaze = @$_SESSION["name"] or "";
$username = @$_SESSION["username"] or "";
$password = @$_SESSION["password"] or "";
$vypnit = @$_SESSION["vypnit"] or "";
if ($databaze == ""){
        $databaze = "kasa_main";
    }
$nazev = $_POST["name"];
$cena = $_POST["cena"];
$barva = $_POST["barva"];
$kategorie = $_POST["zalozky"];

$conn = new mysqli("localhost", "root", "", "$databaze");
$sql = "INSERT INTO $kategorie (Nazev, Cena, Barva)
        VALUES ('$nazev', '$cena', $barva)";
$conn->query($sql);
header("location: http://localhost/Projekty/PRG_projekt/index.php");

?>