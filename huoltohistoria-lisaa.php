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
        <h1>LAITEHALLINTA</h1>



        <form action="huoltohistoria-lisaa.php" method="get"> 
            Laite ID <input type="text" name="serial" > <br>
            Huolto päivämäärä: <input type="text" name="devName"> <br>
            Sisäiset huomiot: <input type="text" name="price"> <br>
            Muut huomiot: <input type="text" name="type"> <br>

            <br><input type="submit" value="Kirjaa laite" name="add">
        </form><br><br>

        <?php
            require_once("db.inc");

            if (isset($_GET["add"])){
                if(count(array_filter($_GET))!=count($_GET)){
                    echo '<p class="validation-text">Täytä kaikki kentät</p>';
                }
                else{
                    $serial= $_GET["serial"];
                    $devName = $_GET["devName"];
                    $price = $_GET["price"];
                    $type = $_GET["type"];



                        $sql = "INSERT INTO huoltohistoria (LaiteID, Huoltopvm, Sisaisethuomiot, Huom)
                        VALUES ('$serial', '$devName', '$price', '$type')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Huoltohistoria lisätty <br><br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    
                
                }
            }



            if (isset($_POST["mod"])){
                
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