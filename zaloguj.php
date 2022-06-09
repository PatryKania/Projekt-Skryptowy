<?php
    session_start();//zaczyna sesje
    unset($_SESSION['error']);
    unset($_SESSION['e_pas1']);
    if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
    {

        header('Location:login.php');
        exit();
    }
    require_once "connect.php";

    $con = @new mysqli($host, $db_user, $db_password, $db_name);
 
    if($con->connect_errno!=0)
    {
        echo "Error!!!".$con->connect_errno;
    }
    else
    {
        $login = $_POST['login'];
        $haslo = $_POST['haslo'];
  
        $sql ="SELECT * FROM uzytkownicy WHERE user='$login' AND pass='$haslo'";

        if($res = @$con->query($sql))
        {
            $how_many = $res->num_rows;
            if($how_many>0)
            {   $_SESSION['logged']=true;
               
                $tab = $res->fetch_assoc();
                $user=$tab['user'];
                $_SESSION['id']=$tab['id'];

                unset($_SESSION['error']);
                 $res->close();
              
                header('Location:index.php');
            }
            else{
                
                $_SESSION['erroro']="Nieprawidłowy login lub hasło! <a href='zmiana.php'>Zmien haslo</a>";
        
                header('Location:login.php');

            }

            

        }
    
        
        $con -> close();    
    }




?>