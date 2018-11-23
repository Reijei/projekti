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
    <?php include 'user-navigation.php'; ?>

        <div class="row">
            <div class="column side">
            </div>
                 <div class="column middle">
        <h1>HUOLTOHISTORIA - HAE</h1>




        <form action="user-huoltohistoria.php" method="get"> 
            LaiteId <input type="text" name="serial" > <br>

            <br><input type="submit" value="Hae" name="Hae">
        </form><br><br>


        <?php
            require_once("db.inc");

            if (isset($_GET["Hae"])){
                $query = "SELECT HuoltoID, LaiteID, huoltopvm, sisaisethuomiot FROM huoltohistoria";
				$tulos = mysqli_query($conn, $query);
				if ( !$tulos ){
					echo "Ei laitteita" . mysqli_error($conn);
				}
				
					echo "<table border=\"1\" align=\"center\">";
					echo "<tr><th>HuoltoID</th>";
					echo "<th>LaiteID</th>";
					echo "<th>PVM</th>";
					echo "<th>Huomiot</th></tr>";
					while ($row = $tulos->fetch_assoc()) { 
						$dID = $row["HuoltoID"];
						$dSerial = $row["LaiteID"]; 
						$dName = $row["huoltopvm"]; 
						$dPrice = $row["sisaisethuomiot"];
					

					
						echo "<tr>";
						echo "<br> " . "<td>" . $dID. "</td>". "<td>" . $dSerial. "</td>" . "<td>" . $dName. "</td>" . "<td>" . $dPrice. "</td>";
						echo "</tr>";
						
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
    } else { // heittää ulos jos ideetä ei ole sessionissa
        header('Location: login.php');
        exit;
?>  
<?php
    }

    ?>
