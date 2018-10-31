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
<meta charset="utf-8">
    <head>
        <title>Asiakas</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php include 'primary-navigation.php'; ?>
    <div class="row">
            <div class="column side">
            </div>
                 <div class="column middle">
        <p>Uusi tilaus</p>

<!-- Tämä sivu näkyy tulevaisuudessa vain ASIAKKAALLE! -->

        <form action="asiakastilaus.php" method="get"> 
            Asiakkaan nimi:	<input type="text" name="customerName" > <br>
			Asiakkaan s-posti: <input type="text" name="customerEmail" > <br>
            Yrityksen nimi: <input type="text" name="customerCompany"> <br>
            Yrityksen osoite: <input type="text" name="customerAddress"> <br>
            Vapaamuotoinen puhdistimen tilaus: <input type="text" name="customerOrder"> <br>
           

            <br><input type="submit" value="Tilaa" name="add">
        </form><br><br>

        <?php
            require_once("db.inc");

            if (isset($_GET["add"])){
                if(count(array_filter($_GET))!=count($_GET)){
                    echo "Täytä kaikki kentät";
                }
                else{
                    $customerName= $_GET["customerName"];
                    $customerEmail = $_GET["customerEmail"];
                    $customerCompany = $_GET["customerCompany"];
                    $customerAddress = $_GET["customerAddress"];
					$customerOrder = $_GET["customerOrder"];

                    $sql = "SELECT * FROM asiakastilaus WHERE asiakasYritys = '$customerCompany'";
                    $result = mysqli_query($conn, $sql);
                    if( mysqli_num_rows($result) > 0 ){
                        echo "Tälle yritykselle on jo tehty laitetilaus!";
                    }
                    else{
                        $sql = "INSERT INTO asiakastilaus (asiakasNimi, asiakasSposti, asiakasYritys, asiakasYritysOsoite, asiakasHakemus)
                        VALUES ('$customerName', '$customerEmail', '$customerCompany', '$customerAddress', '$customerOrder')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Tilaus lähetetty! <br><br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
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
    } else { // heittää ulos jos ideetä ei ole sessionissa
        header('Location: login.php');
        exit;
?>  
<?php
    }