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
<hmtl> 
    <head> 
</head>
<body>
<h2 class="SubTitle">Quest nummer: <?php echo $_GET['id']; ?> </h2>

<php
    } else {
        header("Location: inlog.php");
        exit();
    }
 ?>
</body>
</hmtl>