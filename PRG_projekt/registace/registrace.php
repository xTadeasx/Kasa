<?php
session_start();
$name = @$_SESSION["name"] or "";
$surname = @$_SESSION["surname"] or "";
$username = @$_SESSION["username"] or "";
$password = @$_SESSION["password"] or "";
$vypnit = @$_SESSION["vypnit"] or "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reg.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Registrace/Login</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<!-- Hlavní_část -->
    <div class="container-fluid gx-0" id="main">
        <div id="top">

            <div class="col-fluid text-center" id="text">
                <h1 style="color: white;" id="jmeno">Registrace a login</h1>
            </div>

        </div>

        <div id="bottom">
            <div class="row" id="middle">
                    
                    <div class="col-5 text-center gx-0 border_left float-left" style="height: 100%;" >
                        <div id="bottom" style="height: 100%;">
                        <?php
                            if ($name != ""and $username != "" and $password != ""){
                                ?>
                                <div class="log_in_hotovo">
                                    <h1>Uspěšná Registrace</h1>
                                    <?php
                                        //vytvořit uživatele
                                        $conn = new mysqli("localhost", "root", "", "uzivatele");
                                        $INSERT = "INSERT INTO uzivatel (email, username, password)
                                                VALUES ('$name', '$username', '$password')";
                                        $conn->query($INSERT);
                                        //vytvořit mu databázy
                                        $con = new mysqli("localhost", "root", "");
                                        $sql = "CREATE DATABASE $name";
                                        $con->query($sql);
                                        $connect = new mysqli("localhost", "root", "", "$name");
                                        $tables_alko = "CREATE TABLE `alko` (
                                                            `Id` int(11) NOT NULL,
                                                            `Nazev` varchar(255) DEFAULT NULL,
                                                            `Cena` int(11) DEFAULT NULL,
                                                            `Barva` int(11) DEFAULT NULL
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;";
                                        $tables_barva = "CREATE TABLE `barva` (
                                                            `Id` int(11) NOT NULL,
                                                            `Nazev` varchar(255) DEFAULT NULL
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;";
                                        $insert_barva = "INSERT INTO `barva` (`Id`, `Nazev`) VALUES
                                                        (2, 'White'),
                                                        (3, 'Yellow'),
                                                        (4, 'Green'),
                                                        (5, 'Blue'),
                                                        (6, 'Violet'),
                                                        (7, 'Red'),
                                                        (8, 'Orange'),
                                                        (9, 'Pink'),
                                                        (10, 'Grey'),
                                                        (11, 'Brown');";
                                        $tables_kafe = "CREATE TABLE `kafe` (
                                                            `Id` int(11) NOT NULL,
                                                            `Nazev` varchar(255) DEFAULT NULL,
                                                            `Cena` int(11) DEFAULT NULL,
                                                            `Barva` int(11) DEFAULT NULL
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;";
                                        $tables_koupit = "CREATE TABLE `koupit` (
                                                            `Id` int(11) NOT NULL,
                                                            `Nazev` varchar(255) DEFAULT NULL,
                                                            `Cena` int(11) DEFAULT NULL
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;";
                                        $tables_nealko = "CREATE TABLE `nealko` (
                                                            `Id` int(11) NOT NULL,
                                                            `Nazev` varchar(255) DEFAULT NULL,
                                                            `Cena` int(11) DEFAULT NULL,
                                                            `Barva` int(11) DEFAULT NULL
                                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;";
                                        $tables_obcerstveni = "CREATE TABLE `obcerstveni` (
                                                                `Id` int(11) NOT NULL,
                                                                `Nazev` varchar(255) DEFAULT NULL,
                                                                `Cena` int(11) DEFAULT NULL,
                                                                `Barva` int(11) DEFAULT NULL
                                                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;";
                                        $a_alko = "ALTER TABLE `alko`
                                                    ADD PRIMARY KEY (`Id`),
                                                    ADD KEY `Barva` (`Barva`);";
                                        $a_barva = "ALTER TABLE `barva`
                                                    ADD PRIMARY KEY (`Id`);";
                                        $a_kafe = "ALTER TABLE `kafe`
                                                    ADD PRIMARY KEY (`Id`),
                                                    ADD KEY `Barva` (`Barva`);";
                                        $a_koupit = "ALTER TABLE `koupit`
                                                    ADD PRIMARY KEY (`Id`);";
                                        $a_nelko = "ALTER TABLE `nealko`
                                                    ADD PRIMARY KEY (`Id`),
                                                    ADD KEY `Barva` (`Barva`);";
                                        $a_obcerstveni = "ALTER TABLE `obcerstveni`
                                                    ADD PRIMARY KEY (`Id`),
                                                    ADD KEY `Barva` (`Barva`);";
                                        $al_alko = "ALTER TABLE `alko`
                                                    MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;";
                                        $al_kafe = "ALTER TABLE `kafe`
                                                    MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;";
                                        $al_kopit = "ALTER TABLE `koupit`
                                                    MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;";
                                        $al_nealko = "ALTER TABLE `nealko`
                                                    MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;";
                                        $al_obcerstveni = "ALTER TABLE `obcerstveni`
                                                    MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;";
                                        $alt_alko = "ALTER TABLE `alko`
                                                    ADD CONSTRAINT `alko_ibfk_1` FOREIGN KEY (`Barva`) REFERENCES `barva` (`Id`);";
                                        $alt_kafe = "ALTER TABLE `kafe`
                                                    ADD CONSTRAINT `kafe_ibfk_1` FOREIGN KEY (`Barva`) REFERENCES `barva` (`Id`);";
                                        $alt_nealko = "ALTER TABLE `nealko`
                                                    ADD CONSTRAINT `nealko_ibfk_1` FOREIGN KEY (`Barva`) REFERENCES `barva` (`Id`);";
                                        $alt_obcerstveni = "ALTER TABLE `obcerstveni`
                                                    ADD CONSTRAINT `obcersveni_ibfk_1` FOREIGN KEY (`Barva`) REFERENCES `barva` (`Id`);";
                                        $connect->query($tables_alko);
                                        $connect->query($tables_barva);
                                        $connect->query($tables_kafe);
                                        $connect->query($tables_koupit);
                                        $connect->query($tables_nealko);
                                        $connect->query($tables_obcerstveni);
                                        $connect->query($insert_barva);
                                        $connect->query($a_alko);
                                        $connect->query($a_barva);
                                        $connect->query($a_kafe);
                                        $connect->query($a_koupit);                    
                                        $connect->query($a_nelko);
                                        $connect->query($a_obcerstveni);
                                        $connect->query($al_alko);
                                        $connect->query($al_kafe);
                                        $connect->query($al_kopit);
                                        $connect->query($al_nealko);
                                        $connect->query($al_obcerstveni);
                                        $connect->query($alt_alko);
                                        $connect->query($alt_kafe);
                                        $connect->query($alt_nealko);
                                        $connect->query($alt_obcerstveni);
                                        $_SESSION = [];
                                        header('Location: http://localhost/Projekty/PRG_projekt/index.php');
                                    ?>
                                </div>
                                <?php
                            }
                            else {
                                ?>
                                
                                <div class="log_in">
                                    <?php
                                        if($vypnit !=""){
                                            ?>
                                            <p style="color:red;">vyplňtě zbývající políčka</p>
                                            <?php
                                        }
                                    ?>
                                    <form action="overeni.php" method="POST">
                                        <h4>Registrace</h4>
                                        <label class="label">Jmeno</label>
                                        <br>
                                        <input type="text" name="name" <?php if($name != "" and $name != "povinne"){?>value="<?php echo $name;?>";<?php } else {?>placeholder="povinne"<?php } ?>>
                                        <label class="label">Uživatelské jméno</label>
                                        <br>
                                        <input type="text" name="username" <?php if($username != "" and $username != "povinne"){?>value="<?php echo $username;?>";<?php } else {?>placeholder="povinne"<?php } ?>>
                                        <label class="label">Heslo</label>
                                        <br>
                                        <input type="password" name="password" <?php if($password != "" and $password != "povinne"){?>value="<?php echo $password;?>";<?php } else {?>placeholder="povinne"<?php } ?>>
                                        <input type="submit" name="submit">
                                    </form>
                                </div>
                            <?php
                            }
                            ?>
                                
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-5 text-center gx-0 border_right " style="height: 100%;" >
                    <div id="bottom" style="height: 100%;">
                    <div class="col-md text-center gx-0 border_left" style="height: 100%;" >
                        <div id="bottom" style="height: 100%;">
                            <h4>Login</h4>
                            <form method="post" action="overeni_log.php">
                            <br>
                            <label class="label">Uživatelské jméno</label>
                            <input type="text" name="username" placeholder="Uživatelské jméno">
                            <label class="label">Heslo</label>
                            <input type="password" name="password" placeholder="*******">
                            <input class="border_input "type="submit" name="submit">
                            </form>
                            
                        </div>
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
