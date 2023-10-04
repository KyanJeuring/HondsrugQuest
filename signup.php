<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup</title>
    <link rel="icon" href="assets/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/navBar.css" />
</head>

<body>
    <nav>
        <ul id="navBarLeft">
            <li><a href="./index.html">Home</a></li>
            <li><a href="./Quests.php"></a>Quests</li>
            <li><a href="./leaderboard.html">Leaderboard</a></li>
        </ul>
        <ul id="navBarRight">
            <li><a class="active" href="./signup.php">Sign up</a></li>
            <li><a href="./inlog.php">Login</a></li>

        </ul>
    </nav>
    <h1 id="pageTitle">Account aanmaken</h1>
    <hr>
    <form class="loginform" method="post" action="signup.php">
        <h2 id="subTitle">Gebruikersnaam:</h2>
        <input placeholder="Maak een gebruikersnaam aan..." type="text" name="uName" id="uName">
        <br>
        <h2 id="subTitle">E-mail:</h2>
        <input placeholder="Vul uw Emailadress in..." type="email" name="Email" id="Email">
        <br>
        <h2 id="subTitle">Wachtwoord:</h2>
        <input placeholder="Maak een sterk wachtwoord aan..." type="password" name="pWord" id="pWord">
        <br>
        <h2 id="subTitle">Wachtwoord herhalen:</h2>
        <input placeholder="Herhaal uw wachtwoord..." type="password" id=pWord2>
        <br>
        <input type="submit" value="Meld aan" id="submit">
    </form>
    <h3 id="SubTitle2"> Al een account? Klik <a href="./login.html">hier</a>.</h3>
    <?php

    ?>
</body>

</html>