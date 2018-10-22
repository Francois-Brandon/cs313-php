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
    

<div class="container recipe-container"> 
    <h1>Recent Recipe Submissions</h1>
  <div class="row">


    
   <?php
        foreach ($db->query('SELECT c.name AS name, r.recipe_id AS recipe_id, r.recipe_name AS recipe_name, r.directions AS directions, r.date_created FROM recipe AS r JOIN contributor AS c ON r.contributor_id = c.contributor_id ORDER BY r.date_created ASC LIMIT 3') as $row)
        {
            $recipe_name = htmlspecialchars($row['recipe_name']);
            $recipe_id = htmlspecialchars($row['recipe_id']);
            $ingredients = '';
            $directions = htmlspecialchars($row['directions']);
            
            $stmt = $db->prepare('SELECT item FROM ingredients WHERE recipe_id=:recipe_id');
            $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($rows as $value)
            {
                $ingredients .= htmlspecialchars($value['item']) . '<br>';
            }
            
            

                echo '<div class="col-sm-4">';
                    echo '<div class="panel panel-primary">';
                        echo '<div class="panel-heading">' . $recipe_name . '</div>';
                        echo '<div class="panel-body">' . $ingredients . '</div>';
                        echo '<div class="panel-footer"><a data-toggle="modal" href=\'\#' . $recipe_id . '-modal\'>See More</a></div>';
                    echo '</div>';
                echo '</div>';

            
            echo "<div id=\"" . $recipe_id . "-modal\" class=\"modal fade\" role=\"dialog\">
                <div class=\"modal-dialog\">

                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                            <h4 class=\"modal-title\">" . $recipe_name . "</h4>
                        </div>
                        <div class=\"modal-body\">
                            
                            <p>" . $ingredients . "</p>
                            <p>" . $directions . "</p>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>
                        </div>
                    </div>

                </div>
            </div>";
        }
    ?>
    </div>
</div>
    
<?php require 'res/footer.php'; ?>
    
</body>
</html>