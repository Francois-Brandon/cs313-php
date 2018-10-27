<?php
    
    session_start();

    require 'res/db.php';

if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
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
    
    
<div class="container results-container"> 
    
  <div class="row">
      <h1>My Recipes</h1>
    
   <?php
        $count = 1;
        $username = $_SESSION['username'];


        $query = 'SELECT c.username AS username, r.recipe_id AS recipe_id, r.recipe_name AS recipe_name, r.directions AS directions, r.date_created FROM recipe AS r JOIN login AS c ON r.user_id = c.id WHERE c.username = :username ORDER BY r.date_created DESC';
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $recrows = $statement->fetchAll(PDO::FETCH_ASSOC);
      
        foreach ($recrows as $row)
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

            
        echo '<div id="' . $recipe_id . '-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">' . $recipe_name . '</h4>
                        </div>
                        <div class="modal-body">
                            
                            <p>' . $ingredients . '</p>
                            <p>' . $directions . '</p>
                        </div>
                        <div class="modal-footer">
                            <form role="form" autocomplete="off" action="editrecipe.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="recipe_id" value="' . $recipe_id . '">
                                <button type="submit" class="btn btn-default">Edit</button>
                            </form>
                            <form role="form" autocomplete="off" action="deleterecipe.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="recipe_id" value="' . $recipe_id . '">
                                <button type="submit" class="btn btn-default">Delete</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>';
            
            if (count > 2 && count % 3 == 0) {
                echo '</div><div class="row">';
            }
        }
    ?>
    </div>
</div>
    
<?php require 'res/footer.php'; ?>
    
</body>
</html>