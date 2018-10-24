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
    <p>VARAA</p>


        <?php
            require_once("db.inc");



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