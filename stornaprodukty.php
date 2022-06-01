<?php
  
    require_once "createdb.php";
    require_once "component.php";
    $database = new CreateDb("szopi","produkty");
    require_once "connect.php";
    $con = @new mysqli($host, $db_user, $db_password, $db_name);
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
       
        <a href="index.php"><div id="logo"> <H1 id='logo2'>SZOPI</H1></div> </a>
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
            <a href="stornaprodukty.php?kategoria=Telefony"><li>Telefony
            </li></a>
            <a href="stornaprodukty.php?kategoria=Komputery"><li>Komputry</li></a>
            <a href="stornaprodukty.php?kategoria=Konsole"><li>Konsole</li></a>
            <a href="stornaprodukty.php?kategoria=Gaming"><li>Gaming</li></a>
            
            </ul></li>

        <li><a href="#">Sport i rekreacja</a>
        <ul>
        <a href="stornaprodukty.php?kategoria=Pilka"><li>Piłka nożna</li></a>
        <a href="stornaprodukty.php?kategoria=Bieganie"><li>Bieganie</li></a>
        <a href="stornaprodukty.php?kategoria=Siłownia"><li>Siłownia</li></a>
        <a href="stornaprodukty.php?kategoria=Sportywalki"><li>Sporty walki</li> </a>
        </ul>
    </li>
        <li><a href="#">Dom i ogród</a>
            <ul>
            <a href="stornaprodukty.php?kategoria=Narzędzia"><li>Narzędzia</li></a>
          
            <a href="stornaprodukty.php?kategoria=Dekoracje"><li>Dekoracje</li></a>
            <a href="stornaprodukty.php?kategoria=Oświetlenie"><li>Oświetlenie</li></a>
                
            </ul></li>
        <li><a href="#">Motoryzacja</a>
            <ul>
            <a href="stornaprodukty.php?kategoria=Samochod"><li>Akcesoria do samochodow</li></a>
            <a href="stornaprodukty.php?kategoria=Mycie"><li>Mycie i konserwacja</li></a>
                
                 
            </ul></li>
        <li><a href="#">EKO</a>
            <ul>
            <a href="stornaprodukty.php?kategoria=jedzenie"><li>Żywność</li></a>
            <a href="stornaprodukty.php?kategoria=suplementy"><li>Suplementy</li> </a>
            </ul></li>

      </ol>
      
    </div>

    </div>

            <div id="main">

                <div id="nav">
                   <p>Sortuj:</p>
                   
                <form name='sort' method="POST">
                <input type="checkbox" name="rosnaco" value="Desert Safari" />
                <label for="rosnaco">Cena rosnąco</label>
                <br>
                <input type="checkbox" name="malejaco" value="Desert Safari" />
                <label for="malejaco">Cena malejąca</label>
                <input type="submit" value="zastosuj">
                </form>
                </div>
                <div id="lista">

                <?php
                $kategoria=$_GET['kategoria'];
                $_SESSION['kategoria']=$kategoria;
                 if(isset($_POST['rosnaco']))
                 {
                    $result = $database->getData2($kategoria);
                 }
                 elseif(isset($_POST['malejaco']))
                 {

                    $result = $database->getData3($kategoria);
                 }
                 else
                 {
                    $result = $database->getData($kategoria);
                 };
                
           
             while($row = mysqli_fetch_assoc($result)){
                 component("<p class='nazwa'>".$row['nazwa']."</p>","<p class='cena'>".$row['cena'],$row['obrazek'],$row['id']);
             }
             
             ?>


                </div>



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
     
//     $(document).ready(function(){
//     $('a').click(function(){
//         var kat=$(this).attr('id');

       
//     });
   
// });

    
</script>
</body>
</html>