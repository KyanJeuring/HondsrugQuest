<?php
session_start();
error_reporting(E_ALL);
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {
  if ($_SESSION['uName'] === 'Admin' && $_SESSION['Email'] === 'admin@hondsrugquest.nl' && $_SESSION['id'] === '1') {
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
            <li><a href="./logout.php">Uitloggen</a></li>
        </ul>
    </nav>
    <h1 id="pageTitle">Admin Page</h1>
    <h2 id="subTitle">Hallo, <?php echo $_SESSION['uName']; ?>.</h2>
    <hr>
    <h2 class="subTitle">Quest aanmaken:</h2>
    <div>
        <form action="adminfile.php" method="post" id="FQuest">
            <h2 class="subTitle">Titel:</h2>
            <input placeholder="Voer een titel in..." type="text" name="titel" id="titel">
            <br>
            <h2 class="subTitle">Beschrijving:</h2>
            <input placeholder="voer een beschrijving in..." type="text" name="beschrijving" id="beschrijving">
            <br>
            <h2 class="subTitle">Punten:</h2>
            <input type="number" min="0" max="5" name="punten" id="punten">
            <br><br>
        </form>
        <button form="FQuest" type="submit" class="SubTitle2">Maak aan!</button>
    </div>
    <?php
  $servername = "127.0.0.1";
  $username = "hondsrug_hondsrugquest";
  $password = "hondsrugquest";
  $databasename = "hondsrug_hondsrugquest";

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titel = $_POST['titel'];
    $beschrijving = $_POST['beschrijving'];
    $punten = $_POST['punten'];

    // Connectie aanmaken
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Error array aanmaken
    $error = [];
    // Checken als alle velden zijn ingevult zo niet dan voeg een error melding toe
    if (empty($titel)) {
      $error[] = "Titel is vereist!";
    }
    if (empty($beschrijving)) {
      $error[] = "Beschrijving is vereist!";
    }
    if (empty($punten)) {
      $error[] = "Punten zijn vereist!";
    }
    // Checken als er geen errors zijn
    if (count($error) != 0) {
      print_r($error);
    } else {



      // Connectie checken
      if ($conn->connect_error) {
        die("Connectie gefaald: " . $conn->connect_error);
      }
      echo "Connectie succesvol.";
      $sql = mysqli_query($conn, "SELECT * from Quest WHERE titel ='$titel'");
      if (mysqli_num_rows($sql) > 0) {
        echo "titel bestaat al";
        exit();
      } else {
        $sql = "INSERT INTO Quest (titel, beschrijving, punten)
              VALUES (?,?,?)";
        try {
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("sss", $titel, $beschrijving, $punten);
        } catch (exception $ex) {
          echo "Oeps, er is iets foutgegaan.";
        }

        if ($stmt->execute() === TRUE) {
          echo "Nieuwe quest succesvol aangemaakt.";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
      }
    }
  }
} 
}


  ?>

</body>
</html>