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
		<style>
#infoBOX {
    width: 40%;
    padding: 5px 0;
    text-align: center;
    background-color: #87CEEB;
    margin-top: 10px;
	font-size: 15px;
}
</style>
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
            ?> <div class="tilaukset-content"> <?php
            while ($row = $tulos->fetch_assoc()) { 
                $cName = $row["asiakasNimi"];
                $cEmail = $row["asiakasSposti"]; 
                $cCompany = $row["asiakasYritys"]; 
                $cCompanyAddress = $row["asiakasYritysOsoite"];
                $cOrder = $row["asiakasHakemus"];
                
				
				
				echo '<br><div id="infoBOX"><b> ' . $cName. '</b><br><br><p><i> </i>' . $cEmail. '</p><p><i>- </i>' . $cCompany. '<br>'. $cCompanyAddress.'</p><br><font size="2"><i><b>"' . $cOrder. '"</b></i></font></div>';
                
				
				
            }
?>  </div> <?php


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