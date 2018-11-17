<?php
session_start(); // sessioni ylös

if (isset($_SESSION['id'])) {// tarkistetaan id 
    $id = $_SESSION['id'];
    require_once("db.inc");
    $sql = "SELECT * FROM admin WHERE admin_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $name = $row["tunnus"];
    }
?>
<html>
    <head>
        <title>Edit</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php include 'primary-navigation.php'; ?>
    <div class="row">
            <div class="column side">
            </div>
                 <div class="column middle">
        <p>LAITEHALLINTA</p>

        <?php
            require_once("db.inc");

            $query = "SELECT LaiteID, Sarjanumero, Nimi, Vuokra_hinta, Laitetyyppi, varaus_tila FROM laite";
            //$tulos = mysqli_query($conn, $query);
            if ( !$result = $conn->query($query) ){
                echo "Ei laitteita" . mysqli_error($conn);
            }
            while ($row = $result->fetch_assoc()) { 
                $dID = $row["LaiteID"];
                $dSerial = $row["Sarjanumero"]; 
                $dName = $row["Nimi"]; 
                $dPrice = $row["Vuokra_hinta"];
                $dType = $row["Laitetyyppi"];
                $dCond = $row["varaus_tila"];

                echo '<form method="post">';
                echo " " . $dID. " " . $dSerial. " " . $dName. " " . $dPrice . " " . $dType. " " . $dCond . " " . '<button name="mod" value='.$dID.' type="submit">modify</button>';
                echo '</form>';
            }

            if (isset($_POST["mod"])){
                $moID = $_POST["mod"];
                $query = "SELECT LaiteID, Sarjanumero, Nimi, Vuokra_hinta, Laitetyyppi, varaus_tila FROM laite WHERE LaiteID = $moID";
                if ( !$result = $conn->query($query) ){
                    echo "Ei laitteita" . mysqli_error($conn);
                } 
                while ($row = $result->fetch_assoc()) {
                    $modID = $row["LaiteID"];
                    $modSerial = $row["Sarjanumero"]; 
                    $modName = $row["Nimi"]; 
                    $modPrice = $row["Vuokra_hinta"];
                    $modType = $row["Laitetyyppi"];
                    $modCond = $row["varaus_tila"];
                }

                ?>
                <form action="haelaite.php" method="get"> 
                    LaiteID: <input type="text" name="ID" value="<?php echo htmlspecialchars($modID); ?>" readonly> <br>
                    Sarjanumero: <input type="text" name="serial" value="<?php echo htmlspecialchars($modSerial); ?>" > <br>
                    Nimi: <input type="text" name="devName" value="<?php echo htmlspecialchars($modName); ?>"> <br>
                    Vuokra/kk: <input type="text" name="price" value="<?php echo htmlspecialchars($modPrice); ?>"> <br>
                    Laitetyyppi: <input type="text" name="type" value="<?php echo htmlspecialchars($modType); ?>"> <br>
                    Tila: <input type="radio" name="cond" value="varattu" >Varattu
                    <input type="radio" checked="checked" name="cond" value="vapaa">Vapaa
    
                    <br><input type="submit" value="Tallenna muutokset" name="modify">
                </form><br><br>
                <?php

            }

            if (isset($_GET["modify"])) {
                if(count(array_filter($_GET))!=count($_GET)){
                    echo "Täytä kaikki kentät";
                }
                else{
                    $modID = $_GET["ID"];
                    $serial= $_GET["serial"];
                    $devName = $_GET["devName"];
                    $price = $_GET["price"];
                    $type = $_GET["type"];
                    $cond = "vapaa";
                    $cond = $_GET["cond"];
                    $sql = "UPDATE laite SET Sarjanumero = $serial, Nimi = '$devName', Vuokra_hinta = $price, Laitetyyppi = '$type', varaus_tila = '$cond' WHERE LaiteID = $modID";

                    if ($conn->query($sql) === TRUE) {
                        echo "Laite päivitetty <br><br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    
                
                }

            }




        ?>
        
</div>
  <div class="column side">
  </div>
</div>
<?php include 'footer.php'; ?>
    </body>
</html>
<?php
    } else { // heittää ulos jos ideetä ei ole sessionissaasdasdasdasd
        header('Location: login.php');
        exit;
?>  
<?php
    }