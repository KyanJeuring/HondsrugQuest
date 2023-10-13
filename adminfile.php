<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {
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

    <form method="post" action="Quests.php">
        <h2 id="subTitle">titel</h2>
        <input placeholder="Voer een titel in..." type="text" name="titel" id="titel">
        <br>
        <h2 id="subTitle">beschrijving</h2>
        <input placeholder="voer een beschrijving in..." type="text" name="beschrijving" id="beschrijving">
        <br>
        <h2 id="subTitle">punten</h2>
        <input placeholder="Maak een sterk wachtwoord aan..." type="password" name="pWord" id="pWord">
        <br>
        <input type="submit" value="Meld aan" id="submit">
    </form>
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
    if (empty($uName)) {
      $error[] = "Gebruikersnaam is vereist!";
    }
    if (empty($Email)) {
      $error[] = "Email is vereist!";
    }
    if (empty($pWord)) {
      $error[] = "Wachtwoord is vereist!";
    }
    if (empty($pWord2)) {
      $error[] = "Wachtwoord herhalen is vereist!";
    }
    // Checken als er geen errors zijn
    if (count($error) == 0) {
      if ($pWord != $pWord2) {
        echo "Wachtwoorden zijn niet gelijk!";
      } else {
        header("Location: inlog.php");
      }
    } else {
      print_r($error);
    }

    // Connectie checken
    if ($conn->connect_error) {
      die("Connectie gefaald: " . $conn->connect_error);
    }
    echo "Connectie succesvol.";
    $sql = mysqli_query($conn, "SELECT * from Inloggegevens WHERE uName ='$uName'");
    if (mysqli_num_rows($sql) > 0) {
      echo "Gebruikersnaam is al in gebruik.";
      exit();
    } else {
      $sql = "INSERT INTO Inloggegevens (uName, pWord, Email)
            VALUES (?,?,?)";
      try {
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $uName, $pWord, $Email);
      } catch (exception $ex) {
        echo "Oeps, er is iets foutgegaan.";
      }

      if ($stmt->execute() === TRUE) {
        echo "Nieuw account succesvol aangemaakt.";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $conn->close();
    }
  }

  ?>
</body>

</html>