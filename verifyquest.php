<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {


    require_once("db_config.php");

    // Connectie aanmaken
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Connectie checken
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
<html>
    <head> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hondsrug Quest</title>
    <link rel="icon" href="assets/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/navBar.css" />
</head>
<body>
<nav>
        <ul id="navBarRight">
            <li><a href="./questdetails .php">Terug</a></li>
        </ul>
    </nav>
<h2 class="SubTitle">Verifieer quest <?php echo $_GET['id']; ?> </h2>
<hr>
<div>
<form id="FInlog" action="verifyquest.php?id=<?php echo $_GET['id']; ?>" method="post">
      <h2 class="subTitle">verificatiecode:</h2>
      <input placeholder="Vul de verificatiecode in..." type="text" name="VerCode" id="VerCode">  
    </form>
    <button form="FInlog" type="submit" class="SubTitle2">Verifieer!</button>
</div>
<footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>
</body>
<?php

function validate($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$verCode = validate($_POST['VerCode']);
$Qid = $_GET['id'];
$Uid = $_SESSION['id'];

        $sql = "SELECT * FROM Quest WHERE id='$Qid' AND VerCode='$verCode'";
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);
          $sql = "INSERT INTO `Progress` (`Uid`, `Qid`)
          VALUES (?,?)";
           try {

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $Uid, $Qid);
          } catch (exception $ex) {
            echo "Oeps, er is iets foutgegaan.";
            var_dump($ex);
          }

          if ($stmt->execute() === TRUE) {
            echo "Nieuw account succesvol aangemaakt.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          
        } 
    } else {
        echo 'hoi';
    }
}
?>
</html>