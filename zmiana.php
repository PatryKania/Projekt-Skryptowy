<?php
    session_start();
  
    ?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zmiana hasla</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <div id="reg">
<form method="post"> 

<input type="text" placeholder="login" name="nick"><br>
<?php
unset($_SESSION['error']);

    if(isset($_SESSION['e_nick']))
    {
        echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
        unset($_SESSION['e_nick']);
    }

?>

<input type="text" placeholder="e-mail"name="email"><br>
<?php

    if(isset($_SESSION['e_email']))
    {
        echo '<div class="error">'.$_SESSION['e_email'].'</div>';
        unset($_SESSION['e_email']);
    }

?>

<input type="password" placeholder="nowe hasło" name="haslo1"><br>
<?php
    if(isset($_SESSION['e_pas1']))
    {
        echo '<div class="error">'.$_SESSION['e_pas1'].'</div>';
        unset($_SESSION['e_pas1']);
    }

?>

<input type="password" placeholder=" powtorz hasło" name="haslo2"><br>



<input type="submit" value="Zmien haslo">
</label>
</form>
<a href='login.php'>Wroć</a>
</div>
<?php
if(isset($_SESSION['error']))
{
    echo $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

</body>
</html>
<?php 

if(isset($_POST['email']))
    {
        $state=true;
        $pas1=$_POST['haslo1'];
        $pas2=$_POST['haslo2'];
        $email=$_POST['email'];
        $nick=$_POST['nick'];
    }
        if((strlen($pas1)<8) || (strlen($pas1)>20))
{
    $state=false;
    $_SESSION['e_pas1']="Hasło musi posiadać od 8 do 20 znaków!";
}
if(ctype_alnum($pas1)==false)
{
    $state=false;
    $_SESSION['e_pas1']="Może składać się z liter i cyfr(bez polskich znakow)!";
}
if($pas1!=$pas2)
{
    $state=false;
    $_SESSION['e_pas1']="Podane hasła nie są identyczne!";
}




require_once "connect.php";

    mysqli_report(MYSQLI_REPORT_STRICT);

    try 
    {   
        $con = new mysqli($host, $db_user, $db_password, $db_name);
        if($con->connect_errno!=0)
        {
           throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $res=$con->query("SELECT id FROM uzytkownicy WHERE email='$email'");

            if(!$res)throw new Exception($con->error);
            $how_many_email=$res->num_rows;
            if($how_many_email=0)
            {
                $state=false;
                $_SESSION['e_email']="Emeil nie istnieje w bazie";
            }

            $res=$con->query("SELECT id FROM uzytkownicy  WHERE user='$nick'");

            if(!$res)throw new Exception($con->error);
            $how_many_nick=$res->num_rows;
            if($how_many_nick=0)
            {
                $state=false;
                $_SESSION['e_nick']="Login nieprawidłowy";
            }

            if($state==true)
            {
                if($con->query("UPDATE uzytkownicy SET pass='$pas1' where email='$email' and user='$nick'"))
                
                {
                    //$_SESSION['registered']=true;
                    header('Location: zaloguj.php');
                }
                else
                {
                    throw new Exception($res->error);
                }
             }


            $con->close();
        }

    }
    catch(Exception $error)
    {
        echo "Błąd serwera! Spróbuj później!";
        //echo "<br>".$error;
    }
    





?>

