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
            <ul id="navBarLeft">
                <li><a  href="./index.html">Home</a></li>
                <li><a href="./leaderboard.html">Leaderboard</a></li>
            </ul>
            <ul id="navBarRight">
                <li><a href="./signup.php">Sign up</a></li>
                <li><a class="active" href="./inlog.php">Login</a></li>
            </ul>
        </nav>
            <h1 id="pageTitle">Login</h1>
        <hr>
        <center>
        <form class="loginform" action="inlog.php" method="post">
           <h2 id="subTitle">Gebruikersnaam:</h2>
              <input type="text" name="uName" id="uName" maxlength ="16">
            <br>
            <h2 id="subTitle">Wachtwoord:</h2>
            <input type="password" name="pWord" id="pWord" maxlength ="16">
            <br>
            <input type="submit" value="Inloggen">
          </form>
          </center>
        <h3 id="SubTitle2"> Geen account? Klik <a href="./signup.html">hier</a>.</h3>
        <?php
   $servername = "127.0.0.1";
   $username = "hondsrug_hondsrugquest";
   $password = "hondsrugquest";
   $databasename = "hondsrug_hondsrugquest";
   
   $inputusername = $_POST['uName'];
   $inputpassword = $_POST['pWord'];

   // Create connection
   $conn = new mysqli($servername, $username, $password, $databasename);
   
   // Check connection
   if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   echo "Connected successfully";

   $sql = "INSERT INTO Inloggegevens (uName, pWord)
   VALUES (?,?)";
   try{
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("ss", $inputusername, $inputpassword);
   }catch(exception $ex){
    var_dump($ex);
   }

if ($stmt->execute() === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();   
        ?> 
    </body>
</html>