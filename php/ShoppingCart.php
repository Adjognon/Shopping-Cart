<?php

class ShoppingCart {
    
    static public function addProductToCart($product){

        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }  
         array_push($_SESSION['cart'], $product);
         return true;
    }

    public function payment(){
        
        $finalPrice = 0;
        if(isset($_SESSION['cart'])){
        $products_name = array_keys($_SESSION['cart']);
        
        foreach($products_name as $product_name){
           $finalPrice += $_SESSION['cart'][$product_name]['price'];
           
        }
    }

    $_SESSION['nb_products'] = (isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0);
    $_SESSION['final_price'] = $finalPrice;
        
    }
}