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
        <h1>Hae käyttäjä</h1>




        <form action="modifyuser.php" method="get"> 
            Sähköposti <input type="text" name="serial" > <br>

            <br><input type="submit" value="Hae" name="Hae">
        </form><br><br>


        <?php
            require_once("db.inc");

            if (isset($_GET["Hae"])){
                $email = $_GET["serial"];
                $query = "SELECT admin_id, tunnus, salasana, email, usertype FROM admin WHERE email = '$email'";
				$tulos = mysqli_query($conn, $query);
				if ( !$tulos ){
					echo "Ei käyttäjiä" . mysqli_error($conn);
				}
                
            
					echo "<table border=\"1\" align=\"center\">";
					echo "<tr><th>ID</th>";
					echo "<th>Tunnus</th>";
					echo "<th>Salasana</th>";
                    echo "<th>Email</th>";
                    echo "<th>Käyttäjätyyppi</th>";
                    echo "<th>Muokkaa</th></tr>";
					while ($row = $tulos->fetch_assoc()) { 
						$dID = $row["admin_id"];
						$dSerial = $row["tunnus"]; 
						$dName = $row["salasana"]; 
                        $dPrice = $row["email"];
                        $usertype = $row["usertype"];
					

					    echo '<form method="post">';
						echo "<tr>";
						echo "<br> " . "<td>" . $dID. "</td>". "<td>" . $dSerial. "</td>" . "<td>" . $dName. "</td>" . "<td>" . $dPrice. "</td>" . "<td>" . $usertype. "</td>" . "<td>" . '<button class="btn" name="mod" value='.$email.' type="submit"><i class="fas fa-edit"></i> Muokkaa</button>' . "</td>";
                        echo "</tr>";
                        echo '</form>';
						
            }
					echo"</table>";
                }

                if (isset($_POST["mod"])){
                    $moID = $_POST["mod"];
                    $query = "SELECT admin_id, tunnus, salasana, email, usertype FROM admin WHERE email = '$moID'";
                    if ( !$result = $conn->query($query) ){
                        echo "Ei käyttäjiä" . mysqli_error($conn);
                    } 
                    while ($row = $result->fetch_assoc()) {
						$modID = $row["admin_id"];
						$modSerial = $row["tunnus"]; 
						$modName = $row["salasana"]; 
                        $modPrice = $row["email"];
                        $modusertype = $row["usertype"];
                    }
    
                    ?>
                    <form action="modifyuser.php" method="get"> 
                        ID: <input type="text" name="ID" value="<?php echo htmlspecialchars($modID); ?>" readonly> <br>
                        Tunnus: <input type="text" name="serial" value="<?php echo htmlspecialchars($modSerial); ?>" > <br>
                        Salasana: <input type="text" name="devName" value="<?php echo htmlspecialchars($modName); ?>"> <br>
                        Email: <input type="text" name="price" value="<?php echo htmlspecialchars($modPrice); ?>"> <br>
                        Käyttäjätyyppi: <input type="text" name="type" value="<?php echo htmlspecialchars($modusertype); ?>"> <br>
        
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
                        $sql = "UPDATE admin SET admin_id = $serial, tunnus = '$devName', salasana = $price, email = '$type', usertype = '$cond' WHERE admin_id = $modID";
    
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
    } else { // heittää ulos jos ideetä ei ole sessionissa
        header('Location: login.php');
        exit;
?>  
<?php
    }

    ?>
