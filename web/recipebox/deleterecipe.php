<?php

session_start();
    
require 'res/db.php';

$recipe_id = $_POST['recipe_id'];

$query = 'DELETE FROM recipe WHERE recipe_id = :recipe_id';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->execute();

$query = 'DELETE FROM ingredients WHERE recipe_id = :recipe_id';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->execute();

header("Location: myrecipes.php");
die();

?>