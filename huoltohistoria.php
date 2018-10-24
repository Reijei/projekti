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
            <input type="submit" value="Huoltohistoria" name="huolto">
        </form>

		
		
		
		
        <form action="huoltohistoria.php" method="get"> 
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
					while ($row = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
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
			
			if (isset($_GET["huolto"])){ // Huolto sivulle
                header('Location: huoltohistoria.php');
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
