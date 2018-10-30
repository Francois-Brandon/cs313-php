<?php

session_start();
    
require 'res/db.php';

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
    
$query = 'DELETE FROM favorites WHERE recipe_id = :recipe_id AND user_id = :user_id';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->bindValue(':user_id', $user_id);
$statement->execute();
    


?>