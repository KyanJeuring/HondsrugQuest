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
        <ul id="navBarLeft">
            <li><a href="./index.php">Home</a></li>
            <li><a href="./Quests.php">Quests</a></li>
            <li><a href="./leaderboard.php">Leaderboard</a></li>
        </ul>
        <ul id="navBarRight">
            <li><a class="active" href="./signup.php">Sign up</a></li>
            <li><a href="./inlog.php">Login</a></li>

        </ul>
    </nav>
    <h1 id="pageTitle">Account aanmaken</h1>
    <hr>
    <form class="loginform" method="post" action="signup.php">
        <h2 id="subTitle">Gebruikersnaam:</h2>
        <input placeholder="Maak een gebruikersnaam aan..." type="text" name="uName" id="uName">
        <br>
        <h2 id="subTitle">E-mail:</h2>
        <input placeholder="Vul uw Emailadress in..." type="email" name="Email" id="Email">
        <br>
        <h2 id="subTitle">Wachtwoord:</h2>
        <input placeholder="Maak een sterk wachtwoord aan..." type="password" name="pWord" id="pWord">
        <br>
        <h2 id="subTitle">Wachtwoord herhalen:</h2>
        <input placeholder="Herhaal uw wachtwoord..." type="password" name="pWord2" id=pWord2>
        <br>
        <button id="subButton" type="submit">Aanmelden</button>
    </form>
    <h3 id="SubTitle2"> Al een account? Klik <a href="./login.html">hier</a>.</h3>
    <?php
  $servername = "127.0.0.1";
  $username = "hondsrug_hondsrugquest";
  $password = "hondsrugquest";
  $databasename = "hondsrug_hondsrugquest";

  $uName = $_POST['uName'];
  $pWord = $_POST['pWord'];
  $pWord2 = $_POST['pWord2'];
  $Email = $_POST['Email'];



  // Connectie aanmaken
  $conn = new mysqli($servername, $username, $password, $databasename);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($uName)) {
      echo "Gebruikersnaam is vereist";
      exit();
    } elseif (empty($Email)) {
      echo "Email is vereist";
      exit();
    } elseif (empty($pWord)) {
      echo "Wachtwoord is vereist";
      exit();
    } elseif (empty($pWord2)) {
      echo "Wachtwoord herhalen is vereist";
      exit();
    } else {
      if ($pWord == $pWord2) {
        echo "Wachtwoorden komen overeen.";
        header("Location: inlog.php");
      } else {
        echo "Wachtwoorden komen niet overeen.";
        exit();
      }
    }
  }
  // Connectie checken
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

  $sql = "INSERT INTO Inloggegevens (uName, pWord, Email)
        VALUES (?,?,?)";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $uName, $pWord, $Email);
  } catch (exception $ex) {
    var_dump($ex);
  }

  if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  ?>
</body>

</html>