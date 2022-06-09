<?php
    
    require_once "createdb.php";
    require_once "component.php";
    require_once "connect.php";
    $con = @new mysqli($host, $db_user, $db_password, $db_name);

    $db= new CreateDB("patryk_kania","produkty");
    if(isset($_POST['remove'])){
        if($_GET['action']=='remove'){
            foreach($_SESSION['cart'] as $key=>$value){
                if($value['product_id']==$_GET['id']){
                    unset($_SESSION['cart'][$key]);
                    echo"<script>alert('produkt usuniety')</script>";
                    echo"<script>window.location='koszyk.php'</script";
                }
            }
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
    <title>Szopi-koszyk</title>
    
        

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
        <a href="stornaprodukty.php?kategoria=Silownia"><li>Siłownia</li></a>
        <a href="stornaprodukty.php?kategoria=Sportywalki"><li>Sporty walki</li> </a>
        </ul>
    </li>
        <li><a href="#">Dom i ogród</a>
            <ul>
            <a href="stornaprodukty.php?kategoria=Narzedzia"><li>Narzędzia</li></a>
          
            <a href="stornaprodukty.php?kategoria=Dekoracje"><li>Dekoracje</li></a>
            <a href="stornaprodukty.php?kategoria=Oswietlenie"><li>Oświetlenie</li></a>
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
        <div id="basket-views">
          <H1>Koszyk</H1>
            <hr>
                <div id="lista">
<?php
$total=0;
if(isset($_SESSION['cart'])){
    $product_id=array_column($_SESSION['cart'],'product_id');
    $result=$db->getData4();
  
    while($row=mysqli_fetch_assoc($result)){
        foreach($product_id as $id){
            if($row['id']==$id){cartElement($row['obrazek'],$row['nazwa'],$row['cena'],$row['id']);
             
                 $total=$total+(int)$row["cena"];
           
            }
        }
    }
}else{
    echo "<h5>Koszyk jest pusty</h>";
}

?>

</div>
</div>
<div id='podsumowanie'>
<hr>
<?php
if(isset($_SESSION['cart'])){
    $count=count($_SESSION['cart']);
    echo "<h6>Ilosc przedmiotow: ($count )</h6>";
}else{
    echo "<h6>Cena:(0 items)</h6>";
}
?>


    <?php echo "<h6>Całkowity koszt: ".$total." zł</h6>";?>

    <button id="zamow">Zamów</button>
</div>

</body>
</html>