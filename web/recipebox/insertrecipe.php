<?php

session_start();
    
require 'res/db.php';

$ingredients = $_POST['ingredients'];
$directions = $_POST['input-directions'];
$name = $_POST['recipe-name'];
$username = $_SESSION['username'];

echo 'Username: ' . $username;

$query = 'SELECT id FROM login WHERE username = :username';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

echo '<br>Query result1: ' . $rows['id'];
echo '<br>Query result2: ' . $rows[0]['id'];

foreach ($rows as $row) {
    $user_id = $row['id'];
}

echo '<br>User ID: ' . $user_id;

/*$query = 'INSERT INTO recipe (recipe_name, user_id, directions) VALUES(:name, :user_id, :directions)';
$statement = $db->prepare($query);
$statement->bindValue(':name', $name);
$statement->bindValue(':user_id', $user_id);
$statement->bindValue(':directions', $directions);
$statement->execute();

$newId = $db->lastInsertId('recipe_recipe_id_seq');


foreach ($ingredients as $item) {
    
$query = 'INSERT INTO ingredients (recipe_id, item) VALUES(:recipe_id, :item)';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $newId);
$statement->bindValue(':item', $item);
$statement->execute();
    
}

header("Location: home.php");
die();*/

?>