<?php
    
    session_start();

    require 'res/db.php';

$badLogin = false;
if (isset($_POST['username']) && isset($_POST['password']))
{

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = 'SELECT password FROM login WHERE username=:username';
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $username);
	$result = $statement->execute();
	if ($result)
	{
		$row = $statement->fetch();
		$hashedPasswordFromDB = $row['password'];

		if (password_verify($password, $hashedPasswordFromDB))
		{

			$_SESSION['username'] = $username;
			header("Location: home.php");
			die(); 
		}
		else
		{
			$badLogin = true;
		}
	}
	else
	{
		$badLogin = true;
	}
}


?>

<html lang="en">
<head>
    <title>Recipe Box</title>
    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="recipe-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    
<?php require 'res/nav.php'; ?>
    
<div class="container results-container">
    <div class="signup-form">
        <form action="signin.php" method="post">
            <h2>Sign In</h2>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>       
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Sign In</button>
            </div>
            <div class="text-center">Don't have an account? <a href="signup.php">Sign Up</a></div>
        </form>
    </div>
</div>

    
<?php require 'res/footer.php'; ?>
    
</body>
</html>