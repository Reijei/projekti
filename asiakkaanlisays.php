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
        <p>ASIAKKAAN LISÄYS</p>



        <form action="asikkaanlisays.php" method="get"> 
            Asiakkaan nimi:<input type="text" name="name" > <br>
            Asiakasluokitus: <input type="text" name="luokitus"> <br>
            Laskutusosoite: <input type="text" name="osoite"> <br>
			Postinumero: <input type="text" name="postinumero"> <br>
			Toimipaikka: <input type="text" name="toimipaikka"> <br>
			Verkkolaskutunnus: <input type="text" name="verkkolaskutunnus"> <br>
			Operaattori: <input type="text" name="operaattori"> <br>
			Laskutusväli: <input type="text" name="laskutusvali"> <br>
			Vakuuttaja: <input type="text" name="vakuuttaja"> <br>
			Yhteyshenkilö: <input type="text" name="yhteyshenkilo"> <br>

            <br><input type="submit" value="Kirjaa laite" name="add">
        </form><br><br>

        <?php
            require_once("db.inc");

            if (isset($_GET["add"])){
                if(count(array_filter($_GET))!=count($_GET)){
                    echo "Täytä kaikki kentät";
                }
                else{
                    $name= $_GET["name"];
					$luokitus= $_GET["luokitus"];
					$osoite= $_GET["osoite"];
					$postinumero= $_GET["postinumero"];
					$toimipaikka= $_GET["toimipaikka"];
					$verkkolaskutunnus= $_GET["verkkolaskutunnus"];
					$operaattori= $_GET["operaattori"];
					$laskutusvali= $_GET["laskutusvali"];
					$vakuuttaja= $_GET["vakuuttaja"];
					$yhteyshenkilo= $_GET["yhteyshenkilo"];


                     $sql = "INSERT INTO asiakas (Asiakas, Asiakasluokitus, Laskutusosoite, postinumero, toimipaikka, verkkolaskutunnus, operaattori, laskutusväli, vakuuttaja, yhteyshenkilö)
                        VALUES ('$name', '$luokitus', '$osoite', '$postinumero', '$toimipaikka', '$verkkolaskutunnus', '$operaattori', '$laskutusvali', '$vakuuttaja', '$yhteyshenkilo')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Status lisätty <br><br>";
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
