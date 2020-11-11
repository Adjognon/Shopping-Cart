<?php

session_start();

class ShoppingCart {
    

    static public function addProductToCart($product){

        if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
        }

        array_push($_SESSION['cart'], $product);
        
        return true;
    }



}