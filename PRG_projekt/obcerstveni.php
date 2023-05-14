<?php
session_start();
$databaze = @$_SESSION["name"];
$username = @$_SESSION["username"] or "";
$password = @$_SESSION["password"] or "";
$vypnit = @$_SESSION["vypnit"] or "";
if ($databaze == ""){
    $databaze = "kasa_main";
}
//Databaze
$conn = new mysqli("localhost", "root", "", "$databaze");

$kafe = array();
$sql_kafe = "SELECT * FROM obcerstveni";
$result_kafe = mysqli_query($conn, $sql_kafe);
if (mysqli_num_rows($result_kafe) > 0) {
    while($row_kafe = mysqli_fetch_assoc($result_kafe)) {
        $kafe[] = $row_kafe;
    }
}
$kasa = array();
$sql_koupit = "SELECT * FROM koupit";
$result_koupit = mysqli_query($conn, $sql_koupit);
if (mysqli_num_rows($result_koupit) > 0) {
    while($row_koupit = mysqli_fetch_assoc($result_koupit)) {
        $kasa[] = $row_koupit;
    }
}
//plocha
$zaplatit = 0;
if (isset($_POST["delete"])){
    mysqli_query($conn, "DELETE FROM koupit WHERE Id=".$_POST["Id"]);
    header("location: index.php");
}
if (isset($_POST["delete_it"])){
    mysqli_query($conn, "DELETE FROM obcerstveni WHERE Id=".$_POST["Id"]);
    header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Kasa</title>
    <style>
        .main {
            color: black;
            border: 1px solid black;

        }
        .test {
            border: 1px solid black;
        }
    </style>

</head>
<body>
<div class="container-lg gx-0 text-center">
  <div class="row" style="height: 550px;">
    <div class="col-3 px-0 main">
        <div class="col-fluid test h-25">
            <div class="col-fluid test h-25">
                <div class="col bg-light text-center h-100">
                <?php
                    if (@$_SESSION["username"] == ""){
                ?> 
                        <a href="registace/registrace.php">
                            <H5>Registace/přihlašení</H5>
                        </a>
                <?php
                    }else {
                ?>
                    <script>
                    function Log_out() {
                      location.replace("odhlasit.php")
                    }
                    </script>
                    <div class="col text-center bg-light text" style="height: 50px;" onclick="Log_out()"><H5>Odpojit</H5></div>
                <?php
                    }
                ?>
                </div>
            </div>
            <div class="col-fluid test h-75">
                <div class="row h-100">
                    <?php
                        if ($password == ""){
                    ?>
                            <div class="col bg-light test"><H1>Nutno se přihlásit</H1></div>
                    <?php
                        }
                        else {
                    ?>
                            <a href="http://localhost/Projekty/PRG_projekt/add/add.php">
                                <div class="col  h-100 test bg-light">
                                    <h1>Přidat položku</h1>
                                </div>
                            </a> 
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-fluid overflow-auto test bg-light" style="height: 60%;">
            <?php
                foreach ($kasa as $produkt) {
                    echo
                        '<div class="col-11 test" style="height: 20%;">'.
                            '<div class="row h-100 ">'.
                                '<div class="col-9 py-2">'.
                                    '<H2>'.
                                        $produkt["Nazev"].
                                    '</H2>'.
                                '</div>'.
                                '<div class="col-3 ">'.
                                    $produkt["Cena"]."Kč".
                                    '<form method="post" action="">'.
                                        '<input type="hidden" name="Id" value="'.$produkt["Id"].'">'.
                                        '<input type="submit" name="delete" class="fa fa-trash-o" value="&#xf014;">'.
                                    '</form>'.
                                '</div>'.
                            '</div>'.
                        '</div>';
                    $zaplatit += $produkt["Cena"];
                    }

            ?>
        </div>
        <div class="col-fluid test" style="height: 15%;">
            <form method="post" action="zaplaceno.php">
                <button class="bg-success py-2" type="submit" style="width: 100%; height: 100%">
                    <H1>Zaplatit: <?php echo $zaplatit; ?></H1>
                </button>
            </form>

        </div>
    </div>
    <div class="col-9 px-0 main">
        <div class="col-fluid test" style="height: 10%;">
            <div class="row h-100 gx-0 text-center">
                <div class="col-3 test py-3 bg-success">
                <a href="http://localhost/Projekty/PRG_projekt/index.php "style="width: 100%; height: 100%">
                    <h2>kafe</h2>
                </a>
                </div>
                <div class="col-3 test py-3 bg-success">
                <a href="http://localhost/Projekty/PRG_projekt/nealko.php"style="width: 100%; height: 100%">
                    <h2>Nealko</h2>
                </a>
                </div>
                <div class="col-3 test py-3 bg-success">
                <a href="http://localhost/Projekty/PRG_projekt/alko.php"style="width: 100%; height: 100%">
                    <h2>Alko</h2>
                </a>
                </div>
                <div class="col-3 test py-3 bg-success">
                <a href="http://localhost/Projekty/PRG_projekt/obcerstveni.php"style="width: 100%; height: 100%">
                    <h2>Občerstvení</h2>
                </a>
                </div>
            </div>
        </div>
        <div class="col-fluid bg-light test overflow-auto " style="height: 90%;">
            <div class="row h-25 gx-0 text-center">
                <?php
                    foreach ($kafe as $produkt) {
                        switch ($produkt["Barva"]){
                            case 2:
                                $pozadi = "White";
                                break;
                            case 3:
                                $pozadi = "Yellow";
                                break;
                            case 4:
                                $pozadi = "Green";
                                break;
                            case 5:
                                $pozadi = "Blue";
                                break;
                            case 6:
                                $pozadi = "Violet";
                                break;
                            case 7:
                                $pozadi = "Red";
                                break;
                            case 8:
                                $pozadi = "Orange";
                                break;
                            case 9:
                                $pozadi = "Pink";
                                break;
                            case 10:
                                $pozadi = "Grey";
                                break;
                            case 11:
                                $pozadi = "Brown";
                                break;
                            default:
                                $pozadi = "White";
                                break;
                        }
                        echo 
                            '<div class="col-3 h-100 text-white" > '.
                                '<div class="col-fluid  float-end">'.
                                '<form method="post" action="">'.
                                    '<input type="hidden" name="Id" value="'.$produkt["Id"].'">'.
                                    '<input type="submit" name="delete_it" class="fa fa-trash-o" value="&#xf014;">'.
                                '</form>'.
                                '</div>'.
                                '<form method="post" action="pridat.php" style="height: 100%; ">'.
                                    '<input type="hidden" value='.$produkt["Nazev"].' name="nazev">'.
                                    '<input type="hidden" value='.$produkt["Cena"].' name="cena">'.
                                    '<button type="submit" style=" width:100%; height: 100%; background-color:'.$pozadi.'">'.
                                        '<div class="col-fluid h-50" ">'.
                                            '<h1>'.
                                                $produkt["Nazev"].
                                            '</h1>'.
                                        '</div>'.
                                        '<div class="col-fluid h-25 float-end">'.
                                            '<h3>'.
                                                $produkt["Cena"]."Kč".
                                            '</h3>'.
                                        '</div>'.
                                    '</button>'.
                                '</form>'.    
                            '</div>';
                    } 
                ?>
            </div>
        </div>
    </div>
  </div>
</div>

</body>
</html>

