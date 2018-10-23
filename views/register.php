<?php
/* Spara user i databas:
1. Hantera post variabler: $_POST
2. Koppling till databas: PDO
3. Spara user i databas */


$pdo = new PDO(
    "mysql:host=localhost;dbname=fed18;charset=utf8",
    "root",
    "root"
);

$username = $_POST["username"];
$password = $_POST["password"];

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$statement = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
//Execute populates the statement and runs it
$statement->execute(
    [
        ":username" => $username,
        ":password" => $hashed_password
    ]
);


header('Location: index.php');



?>