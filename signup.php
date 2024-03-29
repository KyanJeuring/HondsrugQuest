<?php session_start(); ?>
<html lang="nl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Signup</title>
  <link rel="icon" href="assets/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/index.css" />
  <link rel="stylesheet" type="text/css" href="css/navBar.css" />
</head>

<body>
  <nav>
    <ul id="navBarRight">
      <li><a class="active" href="./signup.php">Sign up</a></li>
      <li><a href="./inlog.php">Login</a></li>

    </ul>
  </nav>
  <h1 class="pageTitle">Account aanmaken</h1>
  <hr>
  <div class="divBorder">
    <form class="loginform" method="post" action="signup.php">
      <h2 class="subTitle">Gebruikersnaam:</h2>
      <input placeholder="Maak een gebruikersnaam aan..." type="text" name="uName" id="uName">
      <br>
      <h2 class="subTitle">E-mail:</h2>
      <input placeholder="Vul uw Emailadress in..." type="email" name="Email" id="Email">
      <br>
      <h2 class="subTitle">Wachtwoord:</h2>
      <input placeholder="Maak een sterk wachtwoord aan..." type="password" name="pWord" id="pWord">
      <br>
      <h2 class="subTitle">Wachtwoord herhalen:</h2>
      <input placeholder="Herhaal uw wachtwoord..." type="password" name="pWord2" id=pWord2>
      <br><br>
      <button type="submit" class="SubTitle2">Meld aan</button>
    </form>
    <h3 class="SubTitle2"> Al een account? Klik <a href="./login.php">hier</a>.</h3>
  </div>
  <?php
  require_once("db_config.php");

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uName = $_POST['uName'];
    $pWord = $_POST['pWord'];
    $pWord2 = $_POST['pWord2'];
    $Email = strtolower($_POST['Email']);
    $pwordhash = password_hash($pWord, PASSWORD_DEFAULT);
    // Connectie aanmaken
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Error array aanmaken
    $error = [];
    // Checken als alle velden zijn ingevuld zo niet dan voeg een error melding toe
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
    } else 
    $sql = mysqli_query($conn, "SELECT * from Inloggegevens WHERE Email ='$Email'");
    if (mysqli_num_rows($sql) > 0) {
      echo "E-mail is al in gebruik.";
      exit();
    } else {
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
        $sql = "SELECT * FROM Inloggegevens WHERE uName='$uName'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);
          $_SESSION['uName'] = $row['uName'];
          $_SESSION['Uid'] = $row['Uid'];
          header("Location: index.php");
        }
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $conn->close();
    }
  }
  ?>
  <footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
  </footer>
</body>

</html>