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
                <ul class="navBarLeft">
                    <li><a class="active" href="./index.php">Terug</a></li>
                </ul>
            </nav>
        </header>
        <h2 class="pageTitle">Uitleg</h2>
        <hr>
        <h2 class="SubTitle">Hallo <?php echo $_SESSION['uName']; ?>,<br>Leuk dat je meedoet aan Hondsrug Quest.<br>Ga naar
            de lokalen waar de Quests zijn en voltooi ze om zo hoog mogelijk op het Leaderboard te komen. <br>De eerste 10
            die alle Quests hebben voltooid kunnen een prijs in ontvangst nemen in het ICT lokaal M219 in de Marke.<br>Deze
            zoektocht is van 14:00 uur tot 17:30 uur. Hierna wordt een nieuwe ronde gestart.<br>Veel plezier met de Quests!
        </h2>
        <br><br>
        <h2 class="SubTitle">Zou u bij het verlaten van de school nog aan ons feedback willen geven over onze Website?<br>Uw
            feedback helpt ons om de website te verbeteren.</h2>
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