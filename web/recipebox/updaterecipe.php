<?php

session_start();
    
require 'res/db.php';

$ingredients = $_POST['ingredients'];
$directions = $_POST['input-directions'];
$name = $_POST['recipe-name'];
$recipe_id = $_POST['recipe_id'];
$username = $_SESSION['username'];


$query = 'SELECT id FROM login WHERE username = :username';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


foreach ($rows as $row) {
    $user_id = $row['id'];
}

$query = 'UPDATE recipe SET recipe_name = :name, directions = :directions WHERE recipe_id = :recipe_id';
$statement = $db->prepare($query);
$statement->bindValue(':name', $name);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->bindValue(':directions', $directions);
$statement->execute();

$query = 'DELETE FROM ingredients WHERE recipe_id = :recipe_id';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->execute();


foreach ($ingredients as $item) {
    
$query = 'INSERT INTO ingredients (recipe_id, item) VALUES(:recipe_id, :item)';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->bindValue(':item', $item);
$statement->execute();
    
}

header("Location: myrecipes.php");
die();

?>