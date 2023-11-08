<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {
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
    <nav>
        <ul id="navBarLeft">
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
        $sql = "SELECT * FROM Quest";
        $result = $conn->query($sql);

        if ($result > 0) {
            //quests laten zien
            while ($row = $result->fetch_assoc()) {
                echo "<div class='QDiv'>" . "Titel: " . $row["titel"] . "<br>" . "Punten: " . $row["punten"] . "&nbsp;" . "<a href='./questdetails.php?id=" . $row['id'] . "'>details bekijken  </a>" . "</div>";
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