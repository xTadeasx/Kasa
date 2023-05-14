<?php
session_start();
$databaze = @$_SESSION["name"];
$username = @$_SESSION["username"] or "";
$password = @$_SESSION["password"] or "";
$vypnit = @$_SESSION["vypnit"] or "";
if ($databaze == ""){
    $databaze = "kasa_main";
}
$conn = new mysqli("localhost", "root", "", "$databaze");
$barvy= array();
$sql_barvy = "SELECT * FROM barva";
$result_barvy = mysqli_query($conn, $sql_barvy);
if (mysqli_num_rows($result_barvy) > 0) {
    while($row_barvy = mysqli_fetch_assoc($result_barvy)) {
        $barvy[] = $row_barvy;
    }
}
$id = 2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Registrace/Login</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- Hlavní_část -->
    <div class="container-fluid gx-0" id="main">
        <div id="top">

            <div class="col-fluid text-center" id="text">
                <h1 style="color: white;" id="jmeno">Přidat</h1>
            </div>

        </div>

        <div id="bottom">
            <div class="row" id="middle">
                    
                    <div class="col text-center gx-0 border_left float-left" style="height: 100%;" >
                        <div id="bottom" style="height: 100%;">     
                                <div class="log_in">
                                    <form action="pridat_in.php" method="POST">
                                        <label class="label">nazev</label>
                                        <br>
                                        <input type="text" name="name">
                                        <label class="label">Cena</label>
                                        <br>
                                        <input type="text" name="cena">
                                        <br>
                                        <label>Barva</label>
                                        <select name="barva">
                                            <?php
                                                foreach ($barvy as $barva){
                                                    echo '<option value='.$id.'>'.$barva["Nazev"].'</option>';
                                                    $id++;
                                                }

                                            ?>
                                        </select>
                                        <label>Založky</label>
                                        <select name="zalozky">
                                            <option value="kafe">Kafe</option>            
                                            <option value="nealko">Nealko</option>
                                            <option value="alko">Alko</option>
                                            <option value="obcerstveni">Občerstvení</option>
                                        </select>
                                        <input type="submit" name="submit">
                                    </form>
                                </div>
                                
                        </div>
                    </div>
                </div>
        </div>
        
    </div>
<!-- Hlavní_část-konec -->

<script src="bootstrap.js"></script>
</body>
</html>
