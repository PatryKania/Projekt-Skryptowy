<?php
 session_start();

 if(isset($_SESSION['logged']) && $_SESSION['logged']==true)
 {
     header('Location:index.php');
     exit();
 }
 ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <div id="log">
   
<form action="zaloguj.php" method="post"> 

<input type="text" name="login" placeholder="login">

<input type="password" name="haslo" placeholder="hasło">

<input type="submit" value="Zaloguj się">

</form>

<a href="register.php">Zarejestuj sie</a>
<br>
<?php
if(isset($_SESSION['erroro']))
{
    echo '<div class="error">'.$_SESSION['erroro'].'</div>';
    unset($_SESSION['erroro']);
}
?>
</div>


</body>
</html>