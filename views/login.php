<?php

session_start();
/*
1. Koppla upp till databasen
2. Hamta user fran databasen
3. Kolla sa att password i databasen stammer 
    overens med password som user har skrivit in 
    i form: password_verify
*/   

$pdo = new PDO(
    "mysql:host=localhost;dbname=fed18;charset=utf8",
    "root",
    "root"
);

$username = $_POST["username"];
$password = $_POST["password"];


$statement = $pdo->prepare("SELECT * FROM users
WHERE username = :username");
//Execute populates the statement and runs it
$statement->execute(
    [
        ":username" => $username
    ]
);

//When select is used, fetch must happen
$fetched_user = $statement->fetch();

//Double check if everything is working
var_dump($fetched_user);



// 3. Compare
//the first password is from the form, the second comes from the database
$is_password_correct = password_verify($password, $fetched_user["password"]);

if($is_password_correct) {
    // Save user globally to session
    $_SESSION["username"] = $fetched_user["username"];
    // Go back to frontpage
    header('Location: index.php');
} else {
    // Handle errors, go back to frontpage and populate $_GET
    header('Location: index.php?login_failed=true');
}

?>