<?php

    try
    {
      $dbUrl = getenv('DATABASE_URL');

      $dbOpts = parse_url($dbUrl);

      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');

      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
      echo 'Error!: ' . $ex->getMessage();
      die();
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
    
    
<div class="container">    
  


    
   <?php
        foreach ($db->query('SELECT c.name AS name, r.recipe_id AS recipe_id, r.recipe_name AS recipe_name, r.recipe_body AS recipe_body FROM recipe AS r JOIN contributor AS c ON r.contributor_id = c.contributor_id') as $row)
        {   
            echo '<div class="row">';
            echo '<div class="col-sm-4">';
            echo '<div class="panel panel-primary">';
            echo '<div class="panel-heading">' . $row['recipe_name'] . '</div>';
            echo '<div class="panel-body">' . $row['recipe_body'] . '</div>';
            echo '<div class="panel-footer"><a href=''>See More</a></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    ?>
    
    </div>
    
<?php require 'res/footer.php'; ?>
    
</body>
</html>