<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {

    $servername = "127.0.0.1";
    //$username = "hondsrug_hondsrugquest";
    $username = "hondsrugquest@hondsrug.local";
    $password = "hondsrugquest";
    $databasename = "hondsrug_hondsrugquest";

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
            <h2 class="SubTitle">Quest nummer: <?php echo $_GET['id']; ?> </h2>
           


        <?php
        $sql = "SELECT * FROM `Quest` WHERE `id` = ?";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_GET['id']);
            $stmt->execute();
            $result = $stmt->get_result();
        } catch (exception $ex) {
            var_dump($ex);
        }
        if (true) {
            //quests laten zien
            while ($row = $result->fetch_assoc()) {
                echo "<center>" . "<h2 class='Subtitle'> Titel: " . $row["titel"] . "</h2>" . "<br>" . "<h2 class='subtitle'> beschrijving:" . $row["beschrijving"] . "</h2>" . "&nbsp;" . "<h3 class='subtitle'> Punten: " . $row["punten"] . "&nbsp;" . "</h3>" . "</center>";
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
        <form action="https://hondsrugcollege.com/hondsrugquest/php/verifyquest.php?id=<?php echo $_GET['id'];?>" method="POST">
         <button type="submit" class="SubTitle2"> verifieer quest</button>
        </form>
        </div>
        <footer>
        <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
    </footer>
    </body>

    </html>