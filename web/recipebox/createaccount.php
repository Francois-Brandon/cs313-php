
<?php

$username = $_POST['username'];
$password = $_POST['password'];
if (!isset($username) || $username == ""
	|| !isset($password) || $password == "")
{
	header("Location: signup.php");
	die(); //
}


$username = htmlspecialchars($username);

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

require("db.php");

$query = 'INSERT INTO login(username, password) VALUES(:username, :password)';
$statement = $db->prepare($query);
$statement->bindValue(':username', $username);
$statement->bindValue(':password', $hashedPassword);
$statement->execute();

header("Location: signin.php");
die();

?>