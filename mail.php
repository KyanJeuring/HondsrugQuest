<html lang="nl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Login</title>
    <link rel="icon" href="assets/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/index.css" />
    <link rel="stylesheet" type="text/css" href="css/navBar.css" />
</head>

<body>
    <nav>
        <ul id="navBarRight">
            <li><a href="./inlog.php">Terug</a></li>
        </ul>
    </nav>
    <h1 class="pageTitle"> Wachtwoord vergeten?</h1>
    <hr>
    <h2 class="subTitle">Geen zorgen!</h2>
    <div>
        <form action="mail.php" method="post" id="FMail">
            <h2 class="subTitle">Vul uw E-mail om uw wachtwoord per mail te ontvangen!</h2>
            <input placeholder="Vul uw Email in..." type="text" name="Email" id="Email" />
            <br>
        </form>
        <button form="FMail" type="submit" class="SubTitle2">Verstuur mail!</button>
    </div>
</body>
<footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>

</html>