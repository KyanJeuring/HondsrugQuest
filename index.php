<?php
session_start();
if (isset($_SESSION['Uid']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {
?>
    <html lang="nl">

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
                <li><a class="active" href="./index.php">Home</a></li>
                <li><a href="./Quests.php">Quests</a></li>
                <li><a href="./leaderboard.php">Leaderboard</a></li>
            </ul>
            <ul id="navBarRight">
                <li><a href="./logout.php">Uitloggen</a></li>
            </ul>
        </nav>
        <h2 class="pageTitle">Hallo, <?php echo $_SESSION['uName']; ?>. </h2>
        <hr>
        <footer>
            <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
        </footer>
    </body>


    </html>
<?php
} else {
    header("Location: inlog.php");
    exit();
}
?>