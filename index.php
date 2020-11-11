<?php
session_start();
$products = file_get_contents('products.json');
$productsObject = json_decode($products, true);
$products_name = array_keys($productsObject);
$product_added = false;
isset($_SESSION['cart']) ? $product_added = true : $product_added = false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Numbers Game - Michel Kodjo</title>
    <!-- MDB icon -->
    <link rel="icon" href="./img/logo/5-2-mango-png-picture-thumb.png" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Image and text -->
    <nav class="navbar navbar-dark primary-color">
        <a class="navbar-brand" href="#">
            <img src="./img/logo/5-2-mango-png-picture-thumb.png" height="30" class="d-inline-block align-top"
                alt="mdb logo"> OnlyPommesAndMangoes
        </a>
    </nav>

    <div class="view">

        <div>
            <div class="row">

                <div class="product-container col-md-8">

                    <?php

foreach($products_name as $product_name){
    $productsObject[$product_name];
    ?>

                    <!-- Card -->
                    <div class="card product-card-style">

                        <div class="container">
                            <form method="post" action="./php/controller.php">
                                <div class="row">
                                    <!-- Card image -->
                                    <div class="col-md-3">
                                        <img class="card-img-top product-image"
                                            src="img/products/<?= $productsObject[$product_name]["image"]; ?>"
                                            alt="Card image cap">
                                    </div>
                                    <!-- Card content -->
                                    <div class="card-body col-md-6">
                                        <input type="hidden" name="product_name" value="<?= $product_name ?>">

                                        <!-- Title -->
                                        <h4 class="card-title"><a><?= $product_name ?></a></h4>
                                        <!-- Text -->
                                        <p class="card-text"><?= $productsObject[$product_name]["description"]; ?></p>
                                        <hr>
                                        <h2><?= $productsObject[$product_name]["price"]; ?> $</h2>
                                        <!-- Button -->

                                    </div>
                                </div>
                                <button class="btn blue-gradient float-right" type="submit">Add to card</button>
                            </form>
                        </div>


                    </div>
                    <!-- Card -->
                    <?php
}

?>
                </div>

                <div class="card-style col-md-3">
                    <!-- Card -->
                    <div class="card">
                        <form action="./php/controller.php" method="post">
                            <div class="card-header">
                                <i class="fas fa-shopping-cart fa-4x"></i>
                                <span class="nb-products aqua-gradient">
                                    <?php  echo ($product_added ? count($_SESSION['cart']) : '0')  ?>
                                </span>
                            </div>
                            <!-- Card content -->
                            <div class="card-body cart-body-style">
                                <input type="hidden" name="scan" value="">

                                <?php if($product_added AND $_SESSION['cart'] !== ''){
                                for($i = (count($_SESSION['cart']) - 1); $i >= 0; $i-- ){
                                    $product = $_SESSION['cart'][$i];
                                    ?>

                                <!-- Card -->
                                <div class="cart-product-style">

                                    <div class="container">
                                        <div class="row">
                                            <!-- Card image -->
                                            <div class="col-md-3">
                                                <img class="card-img-top cart-product-image"
                                                    src="img/products/<?= $product["image"]; ?>" alt="Card image cap">
                                            </div>
                                            <!-- Card content -->
                                            <div class="card-body col-md-6 ">
                                                <!-- Title -->
                                                <h6 class="card-title"><a><?= $product["name"] ?></a></h6>
                                                <h4 class="float-right"><?= $product["price"]; ?> $</h4>
                                                <!-- Button -->

                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- Card -->

                                <?php

                                }
                            }else{
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <h6>Empty cart, Add product to cart</h6>
                                </div>
                                <?php
                            }

?>
                            </div>
                            <div class="card-footer ">
                                <?php
                                    if(isset($_SESSION['final_price']) AND isset($_SESSION['nb_products']) AND isset($_SESSION['cart'])){
                                        if($_SESSION['nb_products'] === count($_SESSION['cart'])){
                                        echo '<h3>'.$_SESSION['final_price'].' <sup>$</sup></h3>';
                                        }
                                    }
                                ?>
                                <div class="d-flex justify-content-end">
                                    <?php
                                        if(isset($_SESSION['final_price']) AND $product_added){
                                            if(isset($_SESSION['nb_products']) AND $_SESSION['nb_products']  === count($_SESSION['cart'])){
                                                ?>
                                    <button type="button" class="btn btn-primary purple-gradient" data-toggle="modal"
                                        data-target="#centralModallg">
                                        Checkout
                                    </button>

                                    <?php
                                            }else{
                                                ?>
                                    <button class="btn blue-gradient">Scan</button>
                                    <?php
                                            }
?>

                                    <?php
                                        }else{
                                            ?>
                                    <button class="btn blue-gradient">Scan</button>
                                    <?php
                                        }
                                    ?>

                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>

        </div>

        <!-- Central Modal Small -->
        <div class="modal fade" id="centralModallg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">

            <div class="modal-dialog modal-lg modal-right" role="document">


                <div class="modal-content">
                    <div class="modal-body">
                        <div class="checkout-row">
                            <div class="checkout-col-75">
                                <div class="checkout-">
                                    <form action="">

                                        <div class="checkout-row">
                                            <div class="checkout-col-50">
                                                <h3>Billing Address</h3>
                                                <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                                                <input type="text" id="fname" name="firstname"
                                                    placeholder="John M. Doe">
                                                <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                                <input type="text" id="email" name="email"
                                                    placeholder="john@example.com">
                                                <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                                <input type="text" id="adr" name="address"
                                                    placeholder="542 W. 15th Street">
                                                <label for="city"><i class="fa fa-institution"></i> City</label>
                                                <input type="text" id="city" name="city" placeholder="New York">

                                                <div class="checkout-row">
                                                    <div class="checkout-col-50">
                                                        <label for="state">State</label>
                                                        <input type="text" id="state" name="state" placeholder="NY">
                                                    </div>
                                                    <div class="checkout-col-50">
                                                        <label for="zip">Zip</label>
                                                        <input type="text" id="zip" name="zip" placeholder="10001">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="checkout-col-50">
                                                <h3>Payment</h3>
                                                <label for="fname">Accepted Cards</label>
                                                <div class="icon-container">
                                                    <i class="fab fa-cc-visa" style="color:navy; font-size:34px;"></i>
                                                    <i class="fab fa-cc-mastercard"
                                                        style="color:red; font-size:34px;"></i>
                                                    <i class="fab fa-cc-amex" style="color:blue; font-size:34px;"></i>
                                                    <i class="fab fa-cc-discover"
                                                        style="color:orange; font-size:34px;"></i>
                                                </div>
                                                <label for="cname">Name on Card</label>
                                                <input type="text" id="cname" name="cardname"
                                                    placeholder="John More Doe">
                                                <label for="ccnum">Credit card number</label>
                                                <input type="text" id="ccnum" name="cardnumber"
                                                    placeholder="1111-2222-3333-4444">
                                                <label for="expmonth">Exp Month</label>
                                                <input type="text" id="expmonth" name="expmonth"
                                                    placeholder="September">
                                                <div class="checkout-row">
                                                    <div class="checkout-col-50">
                                                        <label for="expyear">Exp Year</label>
                                                        <input type="text" id="expyear" name="expyear"
                                                            placeholder="2018">
                                                    </div>
                                                    <div class="checkout-col-50">
                                                        <label for="cvv">CVV</label>
                                                        <input type="text" id="cvv" name="cvv" placeholder="352">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <label>
                                            <input type="checkbox" checked="checked" name="sameadr"> Shipping address
                                            same as billing
                                        </label>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark-green">Pay now</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary offers-modal-launch-button" data-toggle="modal"
            data-target="#modal_offers">Voir nos offres</button>
        <div class="modal fade right" id="modal_offers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">

            <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
            <div class="modal-dialog modal-side modal-top-right" role="document">


                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title w-100" id="myModalLabel">Nos Offres</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="offers-img" src="./img/products/580b57fbd9996e24bc43c11c.png" />
                                </div>
                                <div class="col-md-8 offer-text">
                                    <span>Achetez une pomme, otenez-en une gratuitement</span>
                                </div>

                                <div class="col-md-3">
                                    <img class="offers-img" src="./img/products/orange.png" />
                                </div>
                                <div class="col-md-8 offer-text">
                                    <span>Achetez deux oranges, otenez la 3iem gratuitement</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Compris</button>
                    </div>
                </div>
            </div>
        </div>

    </div>


    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Your custom scripts (optional) -->
    <script type="text/javascript"></script>

</body>

</html>