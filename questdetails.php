<?php
session_start();
if (isset($_SESSION['Uid']) && isset($_SESSION['uName'])) {

    require_once("db_config.php");

    // Connectie aanmaken
    $conn = new mysqli($servername, $username, $password, $databasename);

    // Connectie checken
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>

    <html lang="nl">

    <head>

        <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>Details van de Quest</title>
            <link rel="icon" href="assets/favicon.ico" />
            <link rel="stylesheet" type="text/css" href="css/index.css" />
            <link rel="stylesheet" type="text/css" href="css/navBar.css" />
        </head>

    <body>
        <nav>
            <ul id="navBarRight">
                <li><a href="./Quests.php">Terug</a></li>
            </ul>
        </nav>
        <h1 class="pageTitle">Quests details</h1>
        <hr>
        <div>
        <?php
        $sql = "SELECT * FROM `Quest` WHERE `Qid` = ?";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_GET['Qid']);
            $stmt->execute();
            $result = $stmt->get_result();
        } catch (exception $ex) {
            var_dump($ex);
        }
        if (true) {
            //quests laten zien
            while ($row = $result->fetch_assoc()) {
                echo "<center>" . "<h2 class='pageTitle'>" . $row["titel"] . "</h2>" . "<br>" . "<h2 class='Subtitle'> Locatie: " . $row["locatie"] . "</h2>" . "<br>" .  "<h2 class='subtitle'> Beschrijving:<br></h2>" . "<h2 class='subtitle2'>" . $row["beschrijving"] . "</h2>" . "&nbsp;" . "<h3 class='subtitle'> Punten: " . $row["punten"] . "&nbsp;" . "</h3>" . "</center>";
            }
        } else {
            echo "Geen quests beschikbaar.";
        }
        $conn->close();
    } else {
        header("Location: inlog.php");
        exit();
    }

        ?>
        </div>
        <footer>
            <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
        </footer>
    </body>

    </html>