<?php
    
require 'res/db.php';

$ingredients = $_POST['ingredients'];
$directions = $_POST['input-directions'];
$name = $_POST['recipe-name'];


$query = 'INSERT INTO recipe (name, user_id, directions) VALUES(:name, :chapter, :directions)';
$statement = $db->prepare($query);
$statement->bindValue(':name', $name);
$statement->bindValue(':user_id', $user_id);
$statement->bindValue(':directions', $directions);
$statement->execute();

$newId = $pdo->lastInsertId('recipe_recipe_id_seq');


foreach ($ingredients as $item) {
    
$query = 'INSERT INTO ingredients (recipe_id, item) VALUES(:recipe_id, :item)';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $newId);
$statement->bindValue(':item', $item);
$statement->execute();
    
}

header("Location: home.php");
die();

?>