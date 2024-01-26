<?php
session_start();
error_reporting(E_ALL);
if (isset($_SESSION['Uid']) && isset($_SESSION['uName'])) {
  if ($_SESSION['uName'] === 'Admin' && $_SESSION['Uid'] === '1') {
?>
<html lang="nl">



<?php
 require_once("db_config.php");

 // Connectie aanmaken
 $conn = new mysqli($servername, $username, $password, $databasename);
 
 $pWord = $_POST['pWord'];
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
   if (empty($uName)) {
     $error[] = "Gebruikersnaam is vereist!";
   }  if (empty($pWord)) {
    $error[] = "Wachtwoord is vereist!";
  }
  if (empty($pWord2)) {
    $error[] = "Wachtwoord herhalen is vereist!";
  }

   if (count($error) == 0) {
    
     // Checken als de gegevens overeenkomen
     $sql = "SELECT * FROM Inloggegevens WHERE uName='$uName'";
     $result = mysqli_query($conn, $sql);
     if (mysqli_num_rows($result) === 1) {
       $row = mysqli_fetch_assoc($result);
      
      $sql = "INSERT INTO Inloggegevens (uName, pWord, Email)
       VALUES (?,?,?)";
 try {
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("sss", $uName, $pwordhash, $Email);
 } catch (exception $ex) {
   echo "Oeps, er is iets fout gegaan.";
 }

 if ($stmt->execute() === TRUE) {
   echo "Nieuw account succesvol aangemaakt.";
 }else 
     } else {
        echo "er is iets fout gegaan";
     }
    } else {
        exit;
    }






 }
 else {
    exit;
 }