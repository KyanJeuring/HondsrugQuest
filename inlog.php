<?php session_start(); ?>
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
      <li><a href="./signup.php">Sign up</a></li>
      <li><a class="active" href="./inlog.php">Login</a></li>
    </ul>
  </nav>
  <h1 class="pageTitle">Login</h1>
  <hr>
  <div>
    <form id="FInlog" action="inlog.php" method="post">
      <h2 class="subTitle">Gebruikersnaam:</h2>
      <input placeholder="Vul uw gebruikersnaam in..." type="text" name="uName" id="uName">
      <br>
      <h2 class="subTitle">E-mail:</h2>
      <input placeholder="Vul uw Emailadress in..." type="email" name="Email" id="Email">
      <br>
      <h2 class="subTitle">Wachtwoord:</h2>
      <input placeholder="Vul uw wachtwoord in..." type="password" name="pWord" id="pWord">
      <br><br>
    </form>
    <button form="FInlog" type="submit" class="SubTitle2">Login!</button>
    <button onclick='window.location= "https://hondsrugcollege.com/hondsrugquest/php/mail.php"' class="SubTitle2">Mail
      vergeten?</button>
    <h3 class="SubTitle2"> Geen account? Klik <a href="./signup.php">hier</a>.</h3>
     </div>
  <footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>
<?php
    $servername = "127.0.0.1";
    $username = "hondsrug_hondsrugquest";
    $password = "hondsrugquest";
    $databasename = "hondsrug_hondsrugquest";

    // Connectie aanmaken
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Connectie checken
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    // echo "Connected successfully";

    if (isset($_POST['uName']) && isset($_POST['Email']) && isset($_POST['pWord'])) {
      // Validatie proces
      function validate($data)
      {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      $uName = validate($_POST['uName']);
      $pWord = validate($_POST['pWord']);
      $Email = validate($_POST['Email']);

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


      // Checken als er geen errors zijn
      if (count($error) == 0) {

        // Checken als de gegevens overeenkomen
        $sql = "SELECT * FROM Inloggegevens WHERE uName='$uName' AND Email='$Email' AND pWord='$pWord'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
          $row = mysqli_fetch_assoc($result);
          if ($row['uName'] === 'Admin' && $row['Email'] === 'admin@hondsrugquest.nl' && $row['pWord'] === 'AdminHondsrugQuest!') {
            $_SESSION['uName'] = $row['uName'];
            $_SESSION['Email'] = $row['Email'];
            $_SESSION['id'] = $row['id'];
            header("location: adminfile.php");
          } else {
            // Sessie aanmaken voor de gebruiker
            if ($row['uName'] == $uName && $row['Email'] == $Email && $row['pWord'] == $pWord) {
              $_SESSION['uName'] = $row['uName'];
              $_SESSION['Email'] = $row['Email'];
              $_SESSION['id'] = $row['id'];
              header("Location: index.php");
            }
          }
        } else {
          echo "<h2 class='subtitle'>" . "gegevens kloppen niet!" . "</h2>";
        }
      } else {
        print_r($error);
      }
    } else {
      exit();
    }
    ?>
</body>

</html>