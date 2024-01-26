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
    <html>

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
                <li><a href="./leaderboard.php">Leaderboard</a></li>
            </ul>
        </nav>
        <h2 class="SubTitle">Voltooi Quest</h2>
        <hr>
        <?php
            function validate($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $verCode = validate($_POST['VerCode']);
            $Qid = $_GET['Qid'];
            $Uid = $_SESSION['Uid'];
            $VerCode = $_GET['VerCode'];

            $sql = "SELECT * FROM Progress WHERE Qid='$Qid' AND Uid='$Uid'";
            $result = mysqli_query($conn, $sql);
            // Check als de quest al eerder is voltooid
            if (mysqli_num_rows($result) === 0) {
                $sql = "SELECT * FROM Quest WHERE Qid='$Qid' AND VerCode='$VerCode'";
                $result = mysqli_query($conn, $sql);
                // Check als de VerCode klopt
                if (mysqli_num_rows($result) === 1){
                    $sql = "INSERT INTO `Progress` (`Uid`, `Qid`)
                VALUES (?,?)";
                    try {

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("ii", $Uid, $Qid);
                    } catch (exception $ex) {
                        echo "<div class='QDiv subTitle'>" . "Oeps, er is iets fout gegaan!" . "</div>";
                        var_dump($ex);
                    }
                    if ($stmt->execute() === TRUE) {
                        echo "<div class='QDiv subTitle'>" . "De Quest". $row["titel"]. "is voltooid" . "</div>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "<div class='QDiv subTitle'>" . "De Quest". $row["titel"]. "kan met deze code niet voltooid worden!" . "</div>";
                }
            } else {
                echo "<div class='QDiv subTitle'>" . "U heeft de Quest". $row["titel"]. " al voltooid!". "</div>";
            }
        ?>
        <footer>
            <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
        </footer>
    </body>
</html>
<?php
} else {
?>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Hondsrug Quest</title>
        <link rel="icon" href="assets/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        <link rel="stylesheet" type="text/css" href="css/navBar.css" />
    </head>
    <body>
        <div class="divBorder">
            <h2 class="SubTitle">Oeps er is iets fout gegaan!</h2>
            <h2 class="SubTitle">U moet eerst inloggen om de Quest te voltooien!</h2>
            <h2 class="SubTitle">Na het inloggen moet u de QR-Code opnieuw scannen!!</h2>
            <button onclick='window.location= "https://hondsrugcollege.com/hondsrugquest/php/inlog.php"' class="SubTitle2">Login</button>
        </div>
    <footer>
        <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
    </footer>
    </body>
</html>
<?php
    }
?>
