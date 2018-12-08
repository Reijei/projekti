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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    </head>
    <body>
    <?php include 'user-navigation.php'; ?>
    <div class="row">
            <div class="column side">
            </div>
                 <div class="column middle">
        <h1>LAITEHALLINTA</h1>

        <p>Etsi laite sarjanumerolla:</p>

                <form action="user-haelaite.php" method="get"> 
            Sarjanumero <input type="text" name="serial" > <br>

            <br><input type="submit" value="Hae" name="Hae">
        </form><br><br>


        <?php
            require_once("db.inc");

            if (isset($_GET["Hae"])){
                $serial= $_GET["serial"];
                $query = "SELECT LaiteID, Sarjanumero, Nimi, Vuokra_hinta, Laitetyyppi, varaus_tila, seuraavahuolto FROM laite WHERE Sarjanumero = '$serial'";
				$tulos = mysqli_query($conn, $query);
				if ( !$tulos ){
					echo "Ei laitteita" . mysqli_error($conn);
				}
				
                echo "<table border=\"1\" align=\"center\">";
                echo "<tr><th>ID</th>";
                echo "<th>Sarjanumero</th>";
                echo "<th>Nimi</th>";
                echo "<th>Hinta</th>";
                echo "<th>Laitetyyppi</th>";
                echo "<th>Varaus tila</th>";
                echo "<th>Seuraava huolto</th></tr>";
					while ($row = $tulos->fetch_assoc()) { 
                        $dID = $row["LaiteID"];
                        $dSerial = $row["Sarjanumero"]; 
                        $dName = $row["Nimi"]; 
                        $dPrice = $row["Vuokra_hinta"];
                        $dType = $row["Laitetyyppi"];
                        $dCond = $row["varaus_tila"];
                        $huolto = $row["seuraavahuolto"];
					
                        echo '<form method="post">';
                        echo "<tr>";
                        echo "<br>" . "<td>" . $dID. "</td>" . "<td>" . $dSerial. "</td>" . "<td>" . $dName. "</td>" . "<td>" . $dPrice . "</td>" . "<td>" . $dType. "</td>" . "<td>" . $dCond . "<td>" . $huolto . "</td>" . "</td>";
                        echo "</tr>";
                        echo '</form>';
						
            }
					echo"</table>";
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