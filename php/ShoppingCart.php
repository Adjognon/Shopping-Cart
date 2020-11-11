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
        $products_keys = array_keys($_SESSION['cart']);
        
        foreach($products_keys as $product_key){
           $finalPrice += $_SESSION['cart'][$product_key]['price'];
           
        }
    }

    $_SESSION['nb_products'] = (isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0);
    $_SESSION['final_price'] = $finalPrice;
        
    }
}