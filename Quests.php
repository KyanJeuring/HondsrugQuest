<?php
session_start();
if (isset($_SESSION['Uid']) && isset($_SESSION['uName'])) {
?>
    <html lang="nl">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Quests</title>
        <link rel="icon" href="assets/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        <link rel="stylesheet" type="text/css" href="css/navBar.css" />
    </head>

    <body>
    <header class="header">   
              <nav>
                <input class="dropdown-menu" type="checkbox" id="dropdown-menu" />
                <label class = "menu-icon" for="dropdown-menu"><span class="navicon">
                </span> </label> 
                <ul class="menu"> 
                    <li><a href="./index.php">Home</a></li>
                    <li><a class="active" href="./Quests.php">Quests</a></li>
                    <li><a href="./leaderboard.php">Leaderboard</a></li>
             </ul>
            <ul id="navBarRight">
                <li><a href="./logout.php">Uitloggen</a></li>
            </ul>
        </nav>
        <h1 class="pageTitle">Quests</h1>
        <hr>
        <div>
        <?php
        require_once("db_config.php");

        // Connectie aanmaken
        $conn = new mysqli($servername, $username, $password, $databasename);

        // Connectie checken
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM Quest";
        $result = $conn->query($sql);

        if ($result > 0) {
            //quests laten zien
            while ($row = $result->fetch_assoc()) {
                echo "<a class='QLink' href='./questdetails.php?Qid=" . $row['Qid'] . "'>" . "<div class='QDiv subTitle'>" . $row["titel"] . "<br>" . "Punten: " . $row["punten"] . "&nbsp;" . "</div>" . "</a>";
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