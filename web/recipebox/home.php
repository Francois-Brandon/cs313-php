<?php require 'res/db.php'; ?>

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

    
   <?php
        foreach ($db->query('SELECT c.name, r.recipe_id, r.recipe_name, r.recipe_body 
                            FROM recipe AS r
                            JOIN contributor AS c
                            ON r.contributor_id = c.contributor_id') as $row)
        {
          echo '<p>' . $row['r.recipe_name'] . ' - ' . $row['r.recipe_body'];
          echo '</p>';
        }
    ?>
    
<?php require 'res/footer.php'; ?>
    
</body>
</html>