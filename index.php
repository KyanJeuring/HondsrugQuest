<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['uName']) && isset($_SESSION['Email'])) {
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
            <li><a href="./signup.php">Sign up</a></li>
            <li><a href="./inlog.php">Login</a></li>
            <li><a href="./logout.php">Uitloggen</a></li>
        </ul>
    </nav>
    <h1 id="pageTitle">Hondsrug Quest</h1>
    <h2 id="subTitle">Hallo, <?php echo $_SESSION['uName']; ?>. Uw id: <?php echo $_SESSION['id']; ?></h2>
    <hr>
</body>

</html>
<?php
} else {
    header("Location: inlog.php");
    exit();
}
?>