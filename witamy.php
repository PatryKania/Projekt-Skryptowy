<?php
 session_start();

 if(!isset($_SESSION['registered']))
 {
     header('Location:index.php');
     exit();
 }
 else
 {
    unset($_SESSION['registered']);
 }
 if(isset($_SESSION['memory_nick'])) unset($_SESSION['memory_nick']);
 if(isset($_SESSION['memory_email'])) unset($_SESSION['memory_email']);
 if(isset($_SESSION['memory_pasword1'])) unset($_SESSION['memory_pasword1']);
 if(isset($_SESSION['memory_pasword2'])) unset($_SESSION['memory_pasword2']);

 if(isset($_SESSION['e_nick'])) unset($_SESSION['e_nick']);
 if(isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
 if(isset($_SESSION['e_pas1'])) unset($_SESSION['e_pas1']);
 if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
 ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" type="text/css" />
    <title>Logowanie</title>
</head>
<body>
    <div id="powitanie">
    <p>Konto zostało założone!</p>
    <a href="login.php">Zaloguje sie!</a>
    <br><br>
    </div>

</body>
</html>