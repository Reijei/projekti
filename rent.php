<?php
session_start(); // sessioni ylös

if (isset($_SESSION['id'])) {// tarkistetaan id 
    $id = $_SESSION['id'];
    require_once("db.inc");
    $sql = "SELECT * FROM admin WHERE admin_ID = '$id'";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $name = $row["tunnus"];
        $password = $row["salasana"];
        $email = $row["email"];
    }
?>
<html>
    <head>
        <title>rent</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php include 'primary-navigation.php'; ?>
    <div class="row">
            <div class="column side">
            </div>
                 <div class="column middle">
    <h1>VARAA</h1>

        <?php
            require_once("db.inc");




            $query = "SELECT AsiakasID, Asiakas FROM asiakas";
            if ( !$result = $conn->query($query) ){
                echo "Ei asiakkaista" . mysqli_error($conn);
            }
            echo "Asiakkaat<br><br>";

            echo "<table border=\"1\" align=\"center\">";
            echo "<tr><th>Asiakas ID</th>";
            echo "<th>Asiakas</th>";
            echo "<th>Lisää vuokraus</th></tr>";
            while ($row = $result->fetch_assoc()) { 
                $aID = $row["AsiakasID"];
                $a = $row["Asiakas"]; 

                echo '<form method="get">';
                echo "<tr>";
                echo "<br>" . "<td>" . $aID. "</td>" . "<td>" . $a . "</td>" . "<td>" . ' <button class="btn" name="addRent" value='.$aID.' type="submit">Lisää Vuokraus</button>' . "</td>";
                echo "</tr>";
                echo '</form>';



            } 
            echo"</table>";

            if (isset($_GET["addRent"])) {
                $aID = $_GET["addRent"];
                ?>

                <form action="rent.php" method="get"> 
                    Asiakas ID: <input type="text" name="ID" value="<?php echo htmlspecialchars($aID); ?>" readonly> <br>
                    Alkamis päivämäärä: <input type="text" name="alkpvm"> <br>
                    Loppumis päivämäärä: <input type="text" name="loppvm" > <br>
                    Puhelinnumero: <input type="text" name="puh"> <br>
                    Kesto yhteensä: <input type="text" name="kesto"> <br>
                    Kohteen nimi: <input type="text" name="kohde"> <br>
                    Postinumero: <input type="text" name="postinumero"> <br>
                    Toimipaikka: <input type="text" name="toimipaikka"> <br>
                    Kohteen yhteystiedot: <input type="text" name="kohyhd"> <br>
                    Osasto: <input type="text" name="osasto"> <br>
                    Tilatunniste: <input type="text" name="tilatunniste"> <br>
                    Valitse laite:
                    <?php 
                        $query = "SELECT LaiteID, Sarjanumero, Nimi, Vuokra_hinta, Laitetyyppi, varaus_tila FROM laite";
                        if ( !$result = $conn->query($query) ){
                            echo "Ei laitteita" . mysqli_error($conn);
                        }
                        
                        echo "<table border=\"1\" align=\"center\">";
				        echo "<tr><th>Check</th>";
					    echo "<th>Sarjanumero</th>";
					    echo "<th>Nimi</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<br> " . "<td>" . "<input type='radio' name='laite' value='".$row['LaiteID']."' />". "</td>". "<td>" .$row['Sarjanumero']. "</td>". "<td>" .$row['Nimi'] . "</td>";
                            echo "</tr>";


               

						
                        }
                        echo"</table>";
                    ?>
                    <br><input type="submit" value="Tallenna muutokset" name="saveRent">
                </form><br><br>
                
                <?php
            }

            if (isset($_GET["saveRent"])){
                $aID = $_GET["ID"];
                $ap= $_GET["alkpvm"];
                $lp= $_GET["loppvm"];
                $puh = $_GET["puh"];
                $k = $_GET["kesto"];
                $ko = $_GET["kohde"];
                $po = $_GET["postinumero"];
                $to = $_GET["toimipaikka"];
                $koy = $_GET["kohyhd"];
                $os = $_GET["osasto"];
                $ti = $_GET["tilatunniste"];
                $laiteID = $_GET["laite"];
                if(count(array_filter($_GET))!=count($_GET)){
                    echo '<p class="validation-text">Täytä kaikki kentät</p>';
                } else {

                $sql = "INSERT INTO tilaus (AsiakasID, LaiteID, alkpvm, loppupvm, tilaajan_puh, kesto, kohteen_nimi, postinumero, toimipaikka, kohteen_yht, osasto, tilatunniste)
                    VALUES ('$aID', '$laiteID', '$ap', '$lp', '$puh','$k', '$ko','$po','$to','$koy','$os','$ti')";
                if ($conn->query($sql) === TRUE) {
                    echo "Tilaus Lisätty <br><br>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }


            if (isset($_GET["addC"])){
                ?>
                
                <form action="rent.php" method="get"> 
                    Asiakas: <input type="text" name="Asiakas"> <br>
                    Asiakasluokitus: <input type="text" name="Asiakasluokitus" > <br>
                    Laskutusosoite: <input type="text" name="Laskutusosoite"> <br>
                    Postinumero: <input type="text" name="Postinumero"> <br>
                    Toimipaikka: <input type="text" name="Toimipaikka"> <br>
                    Verkkolaskutunnus: <input type="text" name="Verkkolaskutunnus"> <br>
                    Operaattori: <input type="text" name="Operaattori"> <br>
                    Laskutusväli: <input type="text" name="Laskutusväli"> <br>
                    Vakuuttaja: <input type="text" name="Vakuuttaja"> <br>
                    Yhteyshenkilö: <input type="text" name="Yhteyshenkilö"> <br>
                    <br><input type="submit" value="Tallenna muutokset" name="addCust">
                </form><br><br>
                <?php
            }


            if (isset($_GET["addCust"])){
                if(count(array_filter($_GET))!=count($_GET)){
                    echo '<p class="validation-text">Täytä kaikki kentät</p>';
                }
                else{
                    $as= $_GET["Asiakas"];
                    $asLu = $_GET["Asiakasluokitus"];
                    $laOs = $_GET["Laskutusosoite"];
                    $poNu = $_GET["Postinumero"];
                    $toPa = $_GET["Toimipaikka"];
                    $veTu = $_GET["Verkkolaskutunnus"];
                    $op = $_GET["Operaattori"];
                    $laVa = $_GET["Laskutusväli"];
                    $va = $_GET["Vakuuttaja"];
                    $yh = $_GET["Yhteyshenkilö"];

                    
                    $sql = "INSERT INTO asiakas (Asiakas, Asiakasluokitus, Laskutusosoite, Postinumero, Toimipaikka, Verkkolaskutunnus, Operaattori, Laskutusvali, Vakuuttaja, Yhteyshenkilo)
                    VALUES ('$as', '$asLu', '$laOs', '$poNu', '$toPa','$veTu', '$op','$laVa','$va','$yh')";

                    if ($conn->query($sql) === TRUE) {
                        echo "Asiakas Lisätty<br><br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    
                }
            header("location: rent.php"); 
            }



           /* 
            $query = "SELECT LaiteID, Sarjanumero, Nimi, Vuokra_hinta, Laitetyyppi, varaus_tila FROM laite";
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

                echo "<br> " . $dID. " " . $dSerial. " " . $dName. " " . $dPrice . " " . $dType. " " . $dCond;
            }
            */

        ?>
</div>
  <div class="column side">
  </div>
</div>
<?php include 'footer.php'; ?>
    </body>
</html>
<?php
    } else { // heittää ulos jos ideetä ei ole sessionissa
        header('Location: login.php');
        exit;
?>  
<?php
    }