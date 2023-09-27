<html lang="nl">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Signup</title>
        <link rel="icon" href="assets/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        <link rel="stylesheet" type="text/css" href="css/navBar.css" />
    <style>
        textarea {
            resize: none;
        }
    </style>
    </head>
    <body>
        <nav>
        <ul id="navBarLeft">
            <li><a href="./index.html">Home</a></li>
            <li><a href="./leaderboard.html">Leaderboard</a></li>
        </ul>
        <ul id="navBarRight">
            <li><a class="active" href="./signup.php">Sign up</a></li>
            <li><a href="./inlog.php">Login</a></li>
            
        </ul>
        </nav>
    <h1 id="pageTitle">Account aanmaken</h1>
    <hr>
    <form class="loginform" action="signup.html">
        <h2 id="subTitle">Gebruikersnaam:</h2>
           <Textarea maxlength ="16"></Textarea>
         <br>
         <h2 id="subTitle">Wachtwoord:</h2>
         <input type="password" maxlength ="16"></Textarea>
         <br>
         <h2 id="subTitle">Wachtwoord herhalen:</h2>
         <input type="password" maxlength ="16"></Textarea>
         <br>
         <input type="submit" value="Meld aan">
        </form>
        <h3 id="SubTitle2"> Al een account? Klik <a href="./login.html">hier</a>.</h3> 
    </body>
</html>
