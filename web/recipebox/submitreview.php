<?php

session_start();
    
require 'res/db.php';

$recipe_id = $_POST['recipe_id'];
$rating = $_POST['review-rating'];
$comment = $_POST['review-comments'];
$username = $_SESSION['username'];


$query = 'SELECT id FROM login WHERE username = :username';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


foreach ($rows as $row) {
    $user_id = $row['id'];
}


$query = 'INSERT INTO rating (recipe_id, user_id, stars, comment) VALUES ( :recipe_id, :user_id, :rating, :comment)';
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->bindValue(':user_id', $user_id);
$statement->bindValue(':rating', $rating);
$statement->bindValue(':comment', $comment);
$statement->execute();

header("Location: home.php");
die();

?>