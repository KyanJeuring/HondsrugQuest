<html lang="nl">

<head>
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
            <li><a href="./inlog.php">Terug</a></li>
        </ul>
    </nav>
    <h1 class="pageTitle"> Wachtwoord vergeten?</h1>
    <hr>
    <h2 class="subTitle">Geen zorgen!</h2>
    <div>
        <form action="mail.php" method="post" id="FMail">
            <h2 class="subTitle">Vul uw E-mail om uw wachtwoord per mail te ontvangen!</h2>
            <input placeholder="Vul uw Email in..." type="text" name="Email" id="Email" />
            <br>
        </form>
        <button form="FMail" type="submit" class="SubTitle2">Verstuur mail!</button>
    </div>
    <footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>



<?php
require_once("db_config.php");

// Connectie aanmaken
$conn = new mysqli($servername, $username, $password, $databasename);

// Connectie checken
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

if (isset($_POST['Email'])) {
    // Validatie proces
    function validate($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $Email = validate($_POST['Email']);
   

    // Error array aanmaken
    $error = [];
    // Checken als alle velden zijn ingevult zo niet dan voeg een error melding toe
    if (empty($Email)) {
      $error[] = "Email is vereist!";
    }
   


    // Checken als er geen errors zijn
    if (count($error) == 0) {

      // Checken als de gegevens overeenkomen
      $sql = "SELECT * FROM Inloggegevens WHERE Email='$Email'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) === 0) {
        echo "gegevens kloppen niet!";
      } else {
        $row = mysqli_fetch_assoc($result);
      }
    }
}

// een key automatische key genereren 
$key=md5(time()+123456789% rand(4000, 55000000));

// de key encrypten 
$keyhash = password_hash($key, PASSWORD_DEFAULT);
 
// de keyhash in de database stoppen

$sql = "INSERT INTO Inloggegevens (Pword_reset)
VALUES (?)";
try {
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $keyhash);
} catch (exception $ex) {
echo "Oeps, er is iets foutgegaan.";
}

if ($stmt->execute() === TRUE) {
echo "Nieuw account succesvol aangemaakt.";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

echo $keyhash;
?>
</body>
</html>
