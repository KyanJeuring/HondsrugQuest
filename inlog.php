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
    <ul id="navBarLeft">
      <li><a href="./index.php">Home</a></li>
      <li><a href="./Quests.php">Quests</a></li>
      <li><a href="./leaderboard.php">Leaderboard</a></li>
    </ul>
    <ul id="navBarRight">
      <li><a href="./signup.php">Sign up</a></li>
      <li><a class="active" href="./inlog.php">Login</a></li>
    </ul>
  </nav>
  <h1 id="pageTitle">Login</h1>
  <hr>
  <form class="loginform" action="inlog.php" method="post">
    <h2 id="subTitle">Gebruikersnaam:</h2>
    <input placeholder="Vul uw gebruikersnaam in..." type="text" name="uName" id="uName">
    <br>
    <h2 id="subTitle">E-mail:</h2>
    <input placeholder="Vul uw Emailadress in..." type="email" name="Email" id="Email">
    <br>
    <h2 id="subTitle">Wachtwoord:</h2>
    <input placeholder="Vul uw wachtwoord in..." type="password" name="pWord" id="pWord">
    <br>
    <button id="subButton" type="submit">Inloggen</button>
  </form>
  <h3 id="SubTitle2"> Geen account? Klik <a href="./signup.html">hier</a>.</h3>
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
  echo "Connected successfully";

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
    // Checken als alle velden zin ingevult
    if (empty($uName)) {
      echo "Gebruikersnaam is vereist";
      exit();
    } elseif (empty($Email)) {
      echo "Email is vereist";
      exit();
    } elseif (empty($pWord)) {
      echo "Wachtwoord is vereist";
      exit();
    } else {
      // Checken als de gegevens overeenkomen
      $sql = "SELECT * FROM Inloggegevens WHERE uName='$uName' AND Email='$Email' AND pWord='$pWord'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // Sessie aanmaken voor de gebruiker
        if ($row['uName'] === $uName && $row['Email'] === $Email && $row['pWord'] === $pWord) {
          $_SESSION['uName'] = $row['uName'];
          $_SESSION['Email'] = $row['Email'];
          $_SESSION['id'] = $row['id'];
          header("Location: index.php");
          exit();
        } else {
          echo "Gegevens kloppen niet!";
          exit();
        }
      }
    }
  } else {
    exit();
  }
  ?>
</body>

</html>