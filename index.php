<?php
   session_start();
    require_once "createdb.php";
    require_once "component.php";
    $database = new CreateDb("szopi","produkty");
    require_once "connect.php";
    $con = @new mysqli($host, $db_user, $db_password, $db_name);

    if(isset($_POST['dodaj']))
    {
        //print_r($_POST['product_id']);
        if(isset($_SESSION['cart'])){
          $item_array_id = array_column($_SESSION['cart'],"product_id");
            
        
                if(in_array($_POST['product_id'],$item_array_id)){
                    echo "<script>alert('Produukt jest juz w koszyku!')</script>";
                    echo "<script>window.location='index.php'</script>";
                }else{
                    $count=count($_SESSION['cart']);
                    $item_array=array('product_id'=>$_POST['product_id']);
                    $_SESSION['cart'][$count]=$item_array;
                }
        
        
        
        }else{
            $item_array=array('product_id'=>$_POST['product_id']);
            $_SESSION['cart'][0]=$item_array;
            print_r($_SESSION['cart']);
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    
    <script src="jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="css/fontello.css" type="text/css"> 
<link rel="stylesheet" href="style.css" type="text/css" />
    <title>Szopi</title>
    
        

</head>
<body>
<div id="container">
<div id="sticky">
    <div id="header">
       
          <a href="index.php"><div id="logo"> <H1>LOGO</H1></div> </a> 
           <div id=wyloguj>
            <?php
                
            if((isset($_SESSION['logged']) && $_SESSION['logged']==true))
            {
            echo '<a href="logout.php">'.'<i class="icon-logout"></i>'.'<br>'.
            'Wyloguj</a>';
            }
            unset($_SESSION['error']);
            ?>
            </div>
           <div id="koszyk"><a href="koszyk.php">
            <i class="icon-basket"></i>
            <br>
               Koszyk
               <?php
                if(isset($_SESSION['cart'])){
                    $count = count($_SESSION['cart']);
                    echo "<span id='licznik-koszyk'>$count</span>";
                }else
                {
                    echo "<span id='licznik-koszyk'>0</span>";
                }
  ?>
            </a></div>
           <div id="konto"><a href="konto.php">
            <i class="icon-user-o"></i>   
            <br>
            Twoje konto</a></div>

            <div style="clear:both"></div>
      
        
    </div>



  <div id="menu">
      <ol>
          
        <li><a href="#">Elektronika</a>
            <ul>
            <a href=""><li>Telefony</li></a>
            <a href="#"><li>Komputry</li></a>
            <a href="#"><li>Konsole</li></a>
            <a href="#"><li>Gaming</li></a>
            <a href="#"><li>Akcesoria</li> </a>
            </ul></li>

        <li><a href="#">Sport i rekreacja</a>
        <ul>
        <a href="#"><li>Piłka nożna</li></a>
        <a href="#"><li>Bieganie</li></a>
        <a href="#"><li>Siłownia</li></a>
        <a href="#"><li>Chodzenie</li></a>
        <a href="#"><li>Sporty walki</li> </a>
        </ul>
    </li>
        <li><a href="#">Dom i ogród</a>
            <ul>
            <a href="#"><li>Narzędzia</li></a>
            <a href="#"><li>Majsterkowanie</li></a>
            <a href="#"><li>Dekoracje</li></a>
            <a href="#"><li>Oświetlenie</li></a>
                
            </ul></li>
        <li><a href="#">Motoryzacja</a>
            <ul>
            <a href="#"><li>Akcesoria do samochodow</li></a>
            <a href="#"><li>Mycie i konserwacja</li></a>
                
                 
            </ul></li>
        <li><a href="#">EKO</a>
            <ul>
            <a href="#"><li></li></a>
            <a href="#"><li></li> </a>
            </ul></li>

      </ol>
      
    </div>

</div>

    <div id="main">
        <div id="ad">
            <b>Kod na -10%:
        </b><br>
    <b>SZOPI10</b></div>
        <div id="okazje">
             <?php
            $result = $database->getData();
             while($row = mysqli_fetch_assoc($result)){
                 component($row['nazwa'],$row['cena'],$row['obrazek'],$row['id']);
             }
             
             ?>
        <div style="clear:both;display:none"></div>
    </div>

    </div>

    <div id="stopka">
        <div id="kontakt">
           <a href=""><i class="icon-facebook-squared"></i></a>
           <a href=""> <i class="icon-instagram"></i></a>
            <a href=""><div id="tel"><i class="icon-phone-squared"></i></a>
            <a href=""><div id="mail"><i class="icon-mail-squared"></i></a>
            
        </div>
        <div></div>
    </div>

</div>
<script>
 
    $(document).ready(function() {
    var NavY = $('#sticky').offset().top;
      
    var stickyNav = function(){
    var ScrollY = $(window).scrollTop();
           
    if (ScrollY > NavY) { 
        $('#sticky').addClass('sticky');
    } else {
        $('#sticky').removeClass('sticky'); 
    }
    };
      
    stickyNav();
      
    $(window).scroll(function() {
        stickyNav();
    });
    });
     


     
</script>
</body>
</html>