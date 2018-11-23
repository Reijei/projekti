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
    <?php include 'primary-navigation.php'; ?>

        <div class="row">
            <div class="column side">
            </div>
                 <div class="column middle">
        <h1>UUDET KÄYTTÄJÄTUNNUKSET</h1>


        <form action="register.php" method="get"> 
            Käyttäjätunnus <input type="text" name="tunnus" > <br>
            Salasana: <input type="text" name="pass"> <br>
            Salasana uudelleen: <input type="text" name="pass2"> <br>
            Sähköposti: <input type="text" name="email"> <br>
            Käyttäjätyyppi:   <select name="usertypes">
            <option value="user">Normaali käyttäjä</option>
    <option value="admin">Admin</option>
  </select>

            <br><input type="submit" value="Luo tunnukset" name="add">
        </form><br><br>

        <?php
            require_once("db.inc");

            if (isset($_GET["add"])){
                if(count(array_filter($_GET))!=count($_GET)){
                    echo '<p class="validation-text">Täytä kaikki kentät</p>';
                } else if ($_GET["pass"] != $_GET["pass2"]) {
                    echo '<p class="validation-text">Salasanat eivät täsmää</p>';
                }
                else{
                    $tunnus= $_GET["tunnus"];
                    $pass = $_GET["pass"];
                    $email = $_GET["email"];
                    $usertype = $_GET["usertypes"];

                    $sql = "SELECT * FROM admin WHERE tunnus = '$tunnus'";
                    $result = mysqli_query($conn, $sql);
                    if( mysqli_num_rows($result) > 0 ){
                        echo "Tällä tunnuksella on jo rekisteröity käyttäjä <br><br>";
                    }
                    else{
                        $sql = "INSERT INTO admin (tunnus, salasana, email, usertype)
                        VALUES ('$tunnus', '$pass', '$email', '$usertype')";

                        if ($conn->query($sql) === TRUE) {
                            echo "Käyttäjätunnukset luotu <br><br>";
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

    ?>
