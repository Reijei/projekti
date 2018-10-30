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
        <title>Edit</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <?php include 'primary-navigation.php'; ?>
    <div class="row">
            <div class="column side">
            </div>
                 <div class="column middle">
        <h1>Tilaukset</h1>





        <?php
            require_once("db.inc");

 

            $query = "SELECT asiakasNimi, asiakasSposti, asiakasYritys, asiakasYritysOsoite, asiakasHakemus FROM asiakastilaus";
            $tulos = mysqli_query($conn, $query);
            if ( !$tulos ){
                echo "Ei tilauksia" . mysqli_error($conn);
            }
            while ($row = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
                $cName = $row["asiakasNimi"];
                $cEmail = $row["asiakasSposti"]; 
                $cCompany = $row["asiakasYritys"]; 
                $cCompanyAddress = $row["asiakasYritysOsoite"];
                $cOrder = $row["asiakasHakemus"];
                

                echo "<br> " . $cName. " " . $cEmail. " " . $cCompany. " " . $cCompanyAddress . "<br> " . $cOrder . "<br>";
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