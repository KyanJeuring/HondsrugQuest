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
      <li><a href="./index.html">Home</a></li>
      <li><a href="./Quests.php">Quests</a></li>
      <li><a href="./leaderboard.html">Leaderboard</a></li>
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
    <input type="submit" value="Inloggen">
  </form>
  <h3 id="SubTitle2"> Geen account? Klik <a href="./signup.html">hier</a>.</h3>
  <?php
  ?>
</body>

</html>