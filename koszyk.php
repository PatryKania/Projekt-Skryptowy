<?php
    session_start();
    require_once "createdb.php";
    require_once "component.php";
    require_once "connect.php";
    $con = @new mysqli($host, $db_user, $db_password, $db_name);

    $db= new CreateDB("szopi","produkty");
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
        <div id="basket-views">
          <H1>Koszyk</H1>
            <hr>

<?php
$total=0;
if(isset($_SESSION['cart'])){
    $product_id=array_column($_SESSION['cart'],'product_id');
    $result=$db->getData();
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

</div>
</body>
</html>