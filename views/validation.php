<?php
session_start();

//Check if the user has clicked the submit button
if (isset($_POST['submit'])) {
    
  //Get the data from the contact form
   $_SESSION['customer_name'] = $_POST['customer_name'];
   $_SESSION['address'] = $_POST['address'];
   $_SESSION['phone'] = $_POST['phone'];
   $_SESSION['email'] = $_POST['email'];

   //Check if the inputs are empty
   if(empty($_SESSION['customer_name']) || empty($_SESSION['address']) || empty($_SESSION['phone']) || empty($_SESSION['email'])) {
       header("Location: index.php?contact-form=empty");
       exit();
    } else {
        header("Location: checkout.php?success");
    }
} 

?>


