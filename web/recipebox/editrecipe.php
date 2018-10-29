<?php 
    require 'res/db.php'; 
    session_start();
?>

<html lang="en">
<head>
    <title>Recipe Box - Edit Recipe</title>
    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="recipe-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="res/js-recipebox.js" type="text/javascript"></script>
</head>
<body>
    
<?php require 'res/nav.php'; ?>
    
    
    
<div class="container results-container">
	<div class="row submit-panel">
        <div class="control-group" id="fields">    
            <div class="controls"> 
                <?php 
                
                $username = $_SESSION['username'];
                $recipe_id = $_POST['recipe_id'];

                $query = 'SELECT r.recipe_name, r.directions, r.user_id, l.username FROM recipe AS r  JOIN login AS l ON r.user_id = l.id WHERE r.recipe_id = :recipe_id';
                $statement = $db->prepare($query);
                $statement->bindValue(':recipe_id', $recipe_id);
                $statement->execute();
                $recrows = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($recrows as $row) {
                    $recipe_name = htmlspecialchars($row['recipe_name']);
                    
                    $directions = htmlspecialchars($row['directions']);
                    $recipe_user = htmlspecialchars($row['username']);

                    $stmt = $db->prepare('SELECT item FROM ingredients WHERE recipe_id=:recipe_id');
                    $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    $count = sizeOf($rows);
                    $i = 1;
            
            
                    if (isset($_SESSION['username']) && $username == $recipe_user) {
                        echo '<form role="form" autocomplete="off" action="updaterecipe.php" method="post" enctype="multipart/form-data">
                                <h3>Enter your recipe\'s name</h3>
                                <input class="form-control" type="text" name="recipe-name" placeholder="Recipe Name" value="' . $recipe_name . '">
                                <h3>Enter the ingredients for your recipe</h3>';
                
                        foreach ($rows as $value) {
                            $ingredient = htmlspecialchars($value['item']);
                            echo '<div class="entry input-group col-xs-6">
                                    <input class="form-control" name="ingredients[]" type="text" placeholder="1 Cup Sugar" value="' . $ingredient . '"/>
                                    <span class="input-group-btn">';
                            if ($i == $count) {
                                echo '<button class="btn btn-success btn-add" type="button">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>';
                            } 
                            
                            else {
                                echo '<button class="btn btn-danger btn-remove" type="button">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>';
                            }
                            
                                echo '</span>
                                </div>';
                        }
                        echo '<h3>Enter the directions for your recipe</h3>
                            <textarea name="input-directions" rows="20" class="form-control" placeholder="Preheat oven to 375 degrees...">' . $directions . '</textarea>
                    
                            <br><br>
                            <input type="hidden" name="recipe_id" value="' . $recipe_id . '">
                            <input type="submit" name="submit" class="submit action-button" value="Save"/>
                        </form>';
                    }
                    else {
                        echo '<h3 class="center"><a href="signin.php">Sign In to edit your recipes</a></h3>';
                    }
                }
                ?>
                
                <br>
            </div>
        </div>
	</div>
</div>

    
<?php require 'res/footer.php'; ?>
    
</body>
</html>