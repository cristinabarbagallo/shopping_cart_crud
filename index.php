<?php
session_start ();
include('products.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bloom Shop</title>
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
    crossorigin="anonymous">
</head>

<body>

<?php
// Add the buy button which will turn into a remove button after being clicked
  function removeOrBuy ($key) {
    // Check if an item is in the cart by looking for the existence of its ID ($key)
    if (!empty($_SESSION['cart'][$key])) {
        echo "<button class='removeOrBuy' type='submit' name='delete' value='$key'>Remove</button>";
    } else {
        echo "<button class='removeOrBuy' type='submit' name='buy' value='$key'>Buy</button>";
          }
}

// Add the item to the cart
if (isset ($_POST ["buy"])) {
  // Check if the item is not already in the cart
    if (!in_array($_POST ["buy"], $_SESSION['cart'])) {
      // Add new item to the cart
     // echo "Shopping for " . $_POST["buy"];

      $_SESSION ['cart'][$_POST["buy"]] = [
         'name' => $products[$_POST["buy"]]['name'],
         'price' => $products[$_POST["buy"]]['price'],
         'desc' => $products[$_POST["buy"]]['desc'],
         'quantity' => $_POST['quantity']
      ];
              
  }//Delete the item if a remove button has been clicked
} else if (isset ($_POST ['delete'])) { 
   // Remove the item from the cart
     if (!empty($_SESSION['cart'][$_POST["delete"]])) {
          unset($_SESSION['cart'][$_POST["delete"]]);
      }
} else if ($_GET["clear"]) {//Clear the cart
      unset($_SESSION['cart']);
}


//print_r($_SESSION['cart']);

?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Bloom</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <li class="nav-item">
            <i class="fas fa-shopping-cart"></i>
          </li>
        </ul>
      </div>
    </div>
</nav>
    
<main>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
         <h1 class="products-title">Our Products</h1>
      </div>
    </div>
  </div>       
        

  <section class="cards">  
  <?php
  //Display the products by looping through the array $products
  foreach ( $products as $key => $item ) : ?>
     
    <div class="col-sm-12 col-md-4 mb-4">
      <div class="card h-100">
        <form action='index.php' method='POST'>
          <img class="card-img-top" src="<?php echo $item['image']; ?>">
          <div class="card-body">
            <h4 class="card-title" id="title_name"><?php echo $item['name']; ?></h4>
            <h5 name="price"><?php echo $item['price'] . ' kr'; ?></h5>
            <p class="card-text"><?php echo $item['desc']; ?></p>
          </div> 
          <div class="card-footer">
            <input type="number" name="quantity" placeholder="Choose Amount">
            <?php removeOrBuy($key); ?>
          </div> 
        </form>
      </div><!--h-100-->
    </div><!--col-sm-12-->
       
  <?php endforeach; ?> 


    <div class="col-sm-12 text-center">
      <a href='index.php?clear=true'><button class='btn-clear center-block' type='submit'>Clear Cart</button></a> 
    </div>

  </section> 


  <section class="contact-form">
    <div class="container">
       <div class="block-heading">
          <h2>Customer Details</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
       </div>     
       <form action="validation.php" method=POST>
          <div class="row">
            <div class="f col-sm-6">
              <label for="customer_name">Your Name and Surname</label>
              <input type="text" name="customer_name" class="form-control" placeholder="Name and Surname" aria-label="Customer Name">
            </div>
            <div class="form-group col-sm-6">
              <label for="number">Telephone Number</label>
              <input type="number" name="phone" class="form-control" placeholder="Your Phone Number" aria-label="Customer Phone Number">
            </div>
            <div class="form-group col-sm-6">
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control" placeholder="Your Address" aria-label="Customer Address">
            </div>
            <div class="form-group col-sm-6">
              <label for="email">E-mail</label>
              <input type="email" name="email" class="form-control" placeholder="Your E-mail" aria-label="Customer E-mail">
            </div>
            <div class="col-sm-12 text-center"> 
                <button class='btn center-block' type="submit" name="submit"> Checkout</button>
            </div>
          </div>
        </form>


    </div><!-- container -->

 <?php 
  //if the contact-form GET method is not inside the URL 
  if (!isset($_GET['contact-form'])) {
    exit(); //Do nothing, the user hasn't submit the form yet
  } 
  else { 
    $contact_form_check = $_GET['contact-form'];

    //if the contact-form GET method is iside the URL and is equal to empty display error message
    if($contact_form_check == "empty"){
      echo "<p class='error'>You did not fill in all fields!</p>"; 
      exit();
    } 
  }

  ?>

  </section>  

</main>
 
  
</body>
</html>