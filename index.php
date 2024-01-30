<?php
session_start();
if (isset($_SESSION['Uid']) && isset($_SESSION['uName'])) {
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
    <header class="header">
        <nav>
            <input class="dropdown-menu" type="checkbox" id="dropdown-menu" />
            <label class="menu-icon" for="dropdown-menu"><span class="navicon">
                </span> </label>
            <div class="menu">
                <ul class="navBarLeft">
                    <li><a class="active" href="./index.php">Home</a></li>
                    <li><a href="./Quests.php">Quests</a></li>
                    <li><a href="./leaderboard.php">Leaderboard</a></li>
                </ul>
                <ul id="navBarRight">
                    <li><a href="./logout.php">Uitloggen</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <h2 class="pageTitle">Welkom, <?php echo $_SESSION['uName']; ?>. </h2>
    <hr>
    <h2 class="SubTitle"> Klik op 'Quests' in het menu om quests te zoeken. Is dit uw eerste keer hier? Klik dan <a
            href="uitleg.php">hier</a> voor extra uitleg. </h2>
    <br>
    <button onclick='window.location= "https://forms.gle/d6fyWmHQVC6EDqJe9"' class="SubTitle2">Feedback</button>
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