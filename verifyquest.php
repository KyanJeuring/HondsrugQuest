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
        <ul id="navBarLeft">
            <li><a href="./index.php">Home</a></li>
            <li><a href="./Quests.php">Quests</a></li>
            <li><a href="./leaderboard.php">Leaderboard</a></li>
        </ul>
        <ul id="navBarRight">
            <li><a href="./logout.php">Uitloggen</a></li>
        </ul>
    </nav>
<h2 class="SubTitle">Quest nummer: <?php echo $_GET['id']; ?> </h2>
<hr>
<footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>
</body>
<?php
    } else {
        header("Location: inlog.php");
        exit();
    }
 ?>
