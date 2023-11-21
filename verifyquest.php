<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {


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

?>
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
            <li><a href="./questdetails .php">Terug</a></li>
        </ul>
    </nav>
<h2 class="SubTitle">Verifiëren </h2>
<hr>
<div>
<form id="FInlog" action="verifyquest.php" method="post">
      <h2 class="subTitle">verificatiecode:</h2>
      <input placeholder="Vul de verificatiecode in..." type="text" name="VerCode" id="VerCode">  
    </form>
    <button form="FInlog" type="submit" class="SubTitle2">Verifieer!</button>
</div>
<footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>
</body>
<?php

$uName = validate($_POST['uName']);

    } else {
        header("Location: inlog.php");
        exit();
    }
 ?>
