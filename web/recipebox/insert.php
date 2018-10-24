<?php
    
require 'res/db.php';

$ingredients = $_POST['ingredients'];
$directions = $_POST['input-directions'];


$query = 'INSERT INTO recipe (name, contributor_id, directions) VALUES(:book, :chapter, :verse, :content)';
$statement = $db->prepare($query);
$statement->bindValue(':name', $name);
$statement->bindValue(':contributor_id', $contributor_id);
$statement->bindValue(':directions', $directions);
$statement->execute();


?>