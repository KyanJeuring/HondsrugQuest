<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {
?>
<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Leaderboard</title>
    <link rel="icon" href="assets/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/navBar.css" />

</head>

<body>
    <nav>
        <ul id="navBarLeft">
            <li><a href="./index.php">Home</a></li>
            <li><a href="./Quests.php">Quests</a></li>
            <li><a class="active" href="./leaderboard.php">Leaderboard</a></li>
        </ul>
        <ul id="navBarRight">
            <li><a href="./logout.php">Uitloggen</a></li>
        </ul>
    </nav>
    <h1 class="pageTitle">Leaderboard</h1>
    <hr>
    <div>

    </div>
</body>
<footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>

</html>
<?php
} else {
    header("Location: inlog.php");
    exit();
}
?>