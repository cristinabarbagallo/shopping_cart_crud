<?php
 session_start();
 include('products.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Checkout</title>
    <link rel="stylesheet" href="/css/checkout.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
</head>

<body>

<?php

//Get the date with PHP date function
$day = date('l');

//day_of_week function determines the price according to the day of the week
function day_of_week($day) {
    global $total;

    switch ($day) {
        case "Monday":
            return $total / 2;
        case "Wednesday":
            return $total * 1.1;
        case "Friday":
            if($total >= 200) {
                return $total - 20;
            }
    }
    return $total;
}

?>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="details-block">
        <div class="personal-details">
            <h2 class="title">Your Personal Information</h2>
            <p>Your Name:
                <?php echo $_SESSION['customer_name'] ?>.</p> <!-- Printing the name input-->
            <p>Your Address:
                <?php echo $_SESSION['address'] ?>.</p> <!-- Printing the address input-->
            <p>Your Phone Number:
                <?php echo $_SESSION['phone'] ?>.</p> <!-- Printing the phone number input-->
            <p>Your E-mail:
                <?php echo $_SESSION['email'] ?>.</p> <!-- Printing the e-mail input-->
        </div>
        <div class="cart-details">
            <h2 class="title">Your Cart contains:</h2>
            <?php
            // Calculate the price and quantity of the products inside the cart
                $total = 0;
                foreach ( $_SESSION['cart'] as $key ) {
            ?>
            <p>Product:
                <?php echo $key['name']; ?></p>
            <p>Price:
                <?php echo $key['price']; ?>kr</p>
            <p>Quantity:
                <?php echo $key['quantity']; ?></p>

            <?php
                    // Calculate the total cost
                    $total += $key['price'] * $key['quantity'];
                } // end foreach
            ?>

            <hr>

            <p class="bold">Total:
                <?php echo $total ?>kr</p>
            <p>Today's total:
                <?php echo day_of_week($day) . "kr" . "</span>"; ?></p>
            
            <a href="index.php"><button type"submit">Go Back</button></a>
                
        </div>
      </div><!-- details-block -->
    </div><!-- col-sm-12 -->
  </div><!-- row -->
</div><!--container -->



</body>
</html>
