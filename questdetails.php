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
            <ul id="navBarLeft">
                <li><a href="./index.php">Home</a></li>
                <li><a href="./Quests.php">Quests</a></li>
                <li><a href="./leaderboard.php">Leaderboard</a></li>
            </ul>
            <ul id="navBarRight">
                <li><a href="./logout.php">Uitloggen</a></li>
            </ul>
        </nav>
        <h1 id="pageTitle">Quests details</h1>
        <h2>quest nummer: <?php echo $_GET['id']; ?> </h2>
        

        <hr>
 
<?php
$sql = "SELECT * FROM `Quest` WHERE `id` = ?";
try {
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_GET['id']);
  $stmt->execute();
  $result = $stmt->get_result();
} catch(exception $ex)
{
    var_dump($ex);
}
if (true) {
    //quests laten zien
    while ($row = $result->fetch_assoc()) {
        echo "<center>" . "<h1> Titel: " . $row["titel"] . "</h1>" . "." . "<br>" . "<h2> beschrijving:" . $row["beschrijving"] . "</h1>" . "&nbsp;" . "Punten: " . $row["punten"] . "&nbsp;" . "</center>";
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
   </body>

</html>