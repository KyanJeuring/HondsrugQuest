<?php
session_start();
error_reporting(E_ALL);
if (isset($_SESSION['Uid']) && isset($_SESSION['uName'])) {
  if ($_SESSION['uName'] === 'Admin' && $_SESSION['Uid'] === '1') {
?>
<html lang="nl">
head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title> Login</title>
  <link rel="icon" href="assets/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/navBar.css" />
</head>

<body>
  <nav>
    <ul id="navBarRight">
      <li><a href="./signup.php">Sign up</a></li>
      <li><a class="active" href="./inlog.php">Login</a></li>
    </ul>
  </nav>
  <h1 class="pageTitle">Login</h1>
  <hr>
  <div class="divBorder">
    <form id="FInlog" action="inlog.php" method="post">
    <h2 class="subTitle">E-mail adres:</h2>
      <input placeholder="Vul uw E-mail adres in..." type="text" name="eMail" id="eMail">
      <br>
      <h2 class="subTitle">Wachtwoord:</h2>
      <input placeholder="Vul uw wachtwoord in..." type="text" name="pWord1" id="pWord1">
      <br>
      <h2 class="subTitle">Wachtwoord herhalen:</h2>
      <input placeholder="Vul uw wachtwoord in..." type="password" name="pWord2" id="pWord2">
      <br><br>
    </form>
    <button form="FInlog" type="submit" class="SubTitle2">Wachtwoord aanpassen!</button>
  </div>
  <footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
  </footer>


<?php
 require_once("db_config.php");

 // Connectie aanmaken
 $conn = new mysqli($servername, $username, $password, $databasename);
 
 $Email = $_POST['eMail'];
 $pWord = $_POST['pWord1'];
 $pWord2 = $_POST['pWord2'];
 $pwordhash = password_hash($pWord, PASSWORD_DEFAULT);
 // Connectie checken
 if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 }
 // echo "Connected successfully";

 if (isset($_POST['uName'])) {
   // Validatie proces
   function validate($data)
   {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }
   $uName = validate($_POST['uName']);

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
     $sql = "UPDATE Inloggegevens SET pWord=$pwordhash WHERE Email=$eMail";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) === 1) {
       echo "succes!";
       }

 
    } else {
        exit;
    }






 }
 else {
    exit;
 }