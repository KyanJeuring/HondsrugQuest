<?php
session_start();
error_reporting(E_ALL);
if (isset($_SESSION['Uid']) && isset($_SESSION['uName'])) {
  if ($_SESSION['uName'] === 'Admin' && $_SESSION['Uid'] === '1') {
?>
<html lang="nl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Wachtwoord aanpassen</title>
  <link rel="icon" href="assets/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/navBar.css" />
</head>

<body>
  <nav>
    <ul id="navBarRight">
    </ul>
  </nav>
  <h1 class="pageTitle">Wachtwoord aanpassen</h1>
  <hr>
  <div class="divBorder">
    <form id="FInlog" action="pwordchanger.php" method="POST">
    <h2 class="subTitle">E-mailadres:</h2>
      <input placeholder="Vul uw E-mail adres in..." type="text" name="eMail" id="eMail">
      <br>
      <h2 class="subTitle">Wachtwoord:</h2>
      <input placeholder="Vul uw wachtwoord in..." type="password" name="pWord1" id="pWord1">
      <br>
      <h2 class="subTitle">Wachtwoord herhalen:</h2>
      <input placeholder="Vul uw wachtwoord in..." type="password" name="pWord2" id="pWord2">
      <br><br>
      <input type="submit" name="submit" class="" value="Wachtwoord aanpassen">
    </form>
    
  </div>
  <footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
  </footer>


<?php


if(isset($_POST["submit"])){

 require_once("db_config.php");

 // Connectie aanmaken
 $conn = new mysqli($servername, $username, $password, $databasename);
 
 //var_dump($_POST);

 $Email = $_POST['eMail'];
 $pWord = $_POST['pWord1'];
 $pWord2 = $_POST['pWord2'];
 $pwordhash = password_hash($pWord, PASSWORD_DEFAULT);
 // Connectie checken
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }
 // echo "Connected successfully";

   // Validatie proces
   function validate($data)
   {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }

   // Error array aanmaken
   $error = [];
   // Checken als alle velden zijn ingevuld zo niet dan voeg een error melding toe
   if (empty($Email))
   {
     $error[] = "Gebruikersnaam is vereist!";
   }  if (empty($pWord)) {
    $error[] = "Wachtwoord is vereist!";
  }
  if (empty($pWord2)) {
    $error[] = "Wachtwoord herhalen is vereist!";
  }

   if (count($error) == 0) {
    
     // Checken als de gegevens overeenkomen
     $sql = "UPDATE Inloggegevens SET pWord='$pwordhash' WHERE Email='$Email'";
     $result = mysqli_query($conn, $sql);
     if ($result) {
       echo "succes!";
       } else {
        echo "geen succes";
       }

 
    } else {
        exit;
    }


  
  }
}
else {
  header("Location: index.php");
}

 }
 else {
  header("Location: index.php");
 }