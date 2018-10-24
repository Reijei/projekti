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
    </head>
    <body>
        <p>LAITEHALLINTA</p>

        <form action="edit.php" method="get"> 
            <input type="submit" value="Pääsivu" name="main">
        </form>
        
        <form action="edit.php" method="get"> 
            <input type="submit" value="Omat tiedot" name="user">
        </form>

        <form action="edit.php" method="get"> 
            <input type="submit" value="Laitteiden hallinta" name="edit">
        </form>

        <form action="edit.php" method="get"> 
            <input type="submit" value="Varaus" name="rent">
        </form>

        <form action="edit.php" method="get"> 
            <input type="submit" value="Kirjaudu ulos" name="logout">
        </form>

        <form action="edit.php" method="get"> 
            Sarjanumero <input type="text" name="serial" > <br>
            Nimi: <input type="text" name="devName"> <br>
            Vuokra/kk: <input type="text" name="price"> <br>
            Laitetyyppi: <input type="text" name="type"> <br>
            Tila: <input type="radio" name="cond" value="varattu">Varattu
            <input type="radio" checked="checked" name="cond" value="vapaa">Vapaa

            <br><input type="submit" value="Kirjaa laite" name="add">
        </form><br><br>

        <?php
            require_once("db.inc");

            if (isset($_GET["add"])){
                if(count(array_filter($_GET))!=count($_GET)){
                    echo "Täytä kaikki kentät";
                }
                else{
                    $serial= $_GET["serial"];
                    $devName = $_GET["devName"];
                    $price = $_GET["price"];
                    $type = $_GET["type"];
                    $cond = "vapaa";
                    $cond = $_GET["cond"];

                    $sql = "SELECT * FROM laite WHERE Sarjanumero = '$serial'";
                    $result = mysqli_query($conn, $sql);
                    if( mysqli_num_rows($result) > 0 ){
                        echo "Tällä sarjanumerolla on jo rekisteröity laite";
                    }
                    else{
                        $sql = "INSERT INTO laite (Sarjanumero, Nimi, Vuokra_hinta, Laitetyyppi, varaus_tila)
                        VALUES ('$serial', '$devName', '$price', '$type', '$cond')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Laite lisätty <br><br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                
                }
            }

            $query = "SELECT LaiteID, Sarjanumero, Nimi, Vuokra_hinta, Laitetyyppi, varaus_tila FROM laite";
            $tulos = mysqli_query($conn, $query);
            if ( !$tulos ){
                echo "Ei laitteita" . mysqli_error($conn);
            }
            while ($row = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
                $dID = $row["LaiteID"];
                $dSerial = $row["Sarjanumero"]; 
                $dName = $row["Nimi"]; 
                $dPrice = $row["Vuokra_hinta"];
                $dType = $row["Laitetyyppi"];
                $dCond = $row["varaus_tila"];

                echo "<br> " . $dID. " " . $dSerial. " " . $dName. " " . $dPrice . " " . $dType. " " . $dCond;
            }



            if (isset($_GET["main"])){ // mainii
                header('Location: main.php');
                exit;
            }

            if (isset($_GET["user"])){ // Omat tiedoit sivulle
                header('Location: user.php');
                exit;
            }

            if (isset($_GET["edit"])){ // laitehallinta sivulle
                header('Location: edit.php');
                exit;
            }

            if (isset($_GET["rent"])){ // varaus sivulle
                header('Location: rent.php');
                exit;
            }

            if (isset($_GET["logout"])){ // loggaa ulos
                session_unset();
                session_destroy(); 
                header('Location: login.php');
                exit;
            }
        ?>

    </body>
</html>
<?php
    } else { // heittää ulos jos ideetä ei ole sessionissa
        header('Location: login.php');
        exit;
?>  
<?php
    }