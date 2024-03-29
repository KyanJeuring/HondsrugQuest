<?php
session_start();
error_reporting(E_ALL);
if (isset($_SESSION['Uid']) && isset($_SESSION['uName'])) {
  if ($_SESSION['uName'] === 'Admin' && $_SESSION['Uid'] === '1') {
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
      <h1 class="pageTitle">Admin Pagina</h1>
      <hr>
      <h2 class="subTitle">Quest aanmaken:</h2>
      <div class="divBorder">
        <form action="adminfile.php" method="post" id="FQuest">
          <h2 class="subTitle">Titel:</h2>
          <input placeholder="Voer een titel in..." type="text" name="titel" id="titel">
          <br>
          <h2 class="subTitle">Locatie:</h2>
          <input placeholder="Voer een locatie in..." type="text" name="locatie" id="locatie">
          <br>
          <h2 class="subTitle">Beschrijving:</h2>
          <input placeholder="voer een beschrijving in..." type="text" name="beschrijving" id="beschrijving">
          <br>
          <h2 class="subTitle">Punten:</h2>
          <input type="number" min="0" max="5" name="punten" id="punten">
          <br>
          <h2 class="subTitle"> Verificatiecode: </h2>
          <input placeholder="voer een verificatiecode in..." type="text" name="VerCode" id="VerCode">
          <br><br>
        </form>
        <button form="FQuest" type="submit" class="SubTitle2">Maak aan!</button>
        <li><a href="./pwordchanger.php">wachtwoord aanpassen</a></li>
      </div>
  <?php
    require_once("db_config.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $titel = $_POST['titel'];
      $locatie = $_POST['locatie'];
      $beschrijving = $_POST['beschrijving'];
      $punten = $_POST['punten'];
      $VerCode = $_POST['VerCode'];

      // Connectie aanmaken
      $conn = new mysqli($servername, $username, $password, $databasename);

      // Error array aanmaken
      $error = [];
      // Checken als alle velden zijn ingevult zo niet dan voeg een error melding toe
      if (empty($titel)) {
        $error[] = "Titel is vereist!";
      }
      if (empty($locatie)) {
        $error[] = "Locatie is vereist!";
      }
      if (empty($beschrijving)) {
        $error[] = "Beschrijving is vereist!";
      }
      if (empty($punten)) {
        $error[] = "Punten zijn vereist!";
      }
      if (empty($VerCode)) {
        $error[] = "verificatiecode is vereist!";
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
          $sql = "INSERT INTO Quest (titel, locatie, beschrijving, punten, VerCode)
              VALUES (?,?,?,?,?)";
          try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $titel, $locatie, $beschrijving, $punten, $VerCode);
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
  } else {
    header("Location: index.php");
    exit();
}
}


  ?>

    </body>

    </html>