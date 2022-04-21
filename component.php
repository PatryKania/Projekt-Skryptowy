<?php   

function component($nazwa,$cena,$obrazek,$product_id){
    $element = "
    <div>
    <form action='index.php' method='post'>
        <img width='150'src=$obrazek>
        <h5>$nazwa</h5>
        <span>$cena</span>
        <button type='submit' name='dodaj'>Dodaj do koszyka</button>
           <input type='hidden' name='product_id'value=$product_id>
        </form>
        </div>
    ";

    echo $element;
}




function cartElement($obrazek,$nazwa,$cena,$product_id){
    $element="<div>
    <form action='koszyk.php?action=remove&id=$product_id' method='post'>

        <img width='150' src=$obrazek>
        <h5>$nazwa</h5>
        <span>$cena<span>
        
        <button type='submit' name='remove'>Usuń</button>
</form>
</div>
    ";
    
    echo $element;
}

