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
    <div class="divBorder">
        <form action="mail.php" method="post" id="FMail">
            <h2 class="subTitle">Vul uw E-mail om uw wachtwoord per mail te ontvangen!</h2>
            <input placeholder="Vul uw Email in..." type="text" name="Email" id="Email" />
            <br>
        </form>
        <button form="FMail" type="submit" class="SubTitle2">Verstuur mail!</button>
    </div>
    <footer>
    <hr><img src="./assets/HQLogo.png" alt="HondsrugQuestLogo" id="HQLogo">
</footer>



<?php

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require_once("db_config.php");

$mail = new PHPMailer(true);

// Connectie aanmaken
$conn = new mysqli($servername, $username, $password, $databasename);

// Connectie checken
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

if (isset($_POST['Email'])) {
    // Validatie proces
    function validate($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $Email = validate($_POST['Email']);
   

    // Error array aanmaken
    $error = [];
    // Checken als alle velden zijn ingevuld zo niet dan voeg een error melding toe
    if (empty($Email)) {
      $error[] = "Email is vereist!";
    }
   


    // Checken als er geen errors zijn
    if (count($error) == 0) {

      // Checken als de gegevens overeenkomen
      $sql = "SELECT * FROM Inloggegevens WHERE Email='$Email'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) === 0) {
        echo "gegevens kloppen niet!";
      } else {
        $row = mysqli_fetch_assoc($result);
      }
    }

    $mail->setLanguage('nl', '/optional/path/to/language/directory/');
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'HondsrugQuest@outlook.com';                     //SMTP username
    $mail->Password   = 'hondsrug@quest';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;   

      //Ontvangers
      $mail->setFrom('HondsrugQuest@outlook.com', 'No-Reply HondsrugQuest');
      $mail->addAddress('Joeyharms2007@gmail.com', 'Joey harms');     //Add a recipient
     // $mail->addAddress('ellen@example.com');               //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
    //  $mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

        //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Wachtwoord herstellen';
    $mail->Body    = 'test';
    $mail->AltBody = 'test';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>
</body>
</html>
