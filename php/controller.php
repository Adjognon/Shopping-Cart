<?php

include './ShoppingCart.php';

$products = file_get_contents('../products.json');
$productsObject = json_decode($products, true);
    
if(isset($_POST['product_name']) AND trim($_POST['product_name']) !== ''){
    $product_name = trim($_POST['product_name']);
    $product_details = $productsObject[$product_name];
    $product_complete_details = array_push_assoc($product_details, "name", $product_name);
    ShoppingCart::addProductToCart($product_complete_details);
    header('Location: ../index.php');
}else if(isset($_POST['scan'])){
    ShoppingCart::payment();
    header('Location: ../index.php');
}else{
    header('Location: ../index.php');
}


function array_push_assoc($array, $key, $value){
    $array[$key] = $value;
    return $array;
    }
?>