<?php
session_start();

include './ShoppingCart.php';

class Offers extends ShoppingCart{
    const POMME_OFFER = 2;
    const ORANGE_OFFER = 3;

    public function paymentWithOffers(){
        $finalPrice = 0;
        $nb_pomme = 0;
        $nb_orange = 0;
        $first_pomme_index_found = 0;
        $first_orange_index_found = 0;
        if(isset($_SESSION['cart'])){
        $products_keys = array_keys($_SESSION['cart']);
        foreach($products_keys as $product_key){
            if($_SESSION['cart'][$product_key]['name'] === 'Pomme'){
                $nb_pomme++;
                if($nb_pomme === self::POMME_OFFER){
                    $finalPrice += 0;
                    $nb_pomme = 0;
                    $_SESSION['cart'][$product_key]['price'] = 0;
                }else{
                    $finalPrice += $_SESSION['cart'][$product_key]['price'];
                }
            }else{
                $finalPrice += $_SESSION['cart'][$product_key]['price'];
            }
        }

    }

    }
}

?>