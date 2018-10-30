<?php
    
    session_start();

    require 'res/db.php';

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.min.js"></script>
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

                        echo '<h3>' . $recipe_name . '</h3><p>';
                
                        foreach ($rows as $value) {
                            $ingredient = htmlspecialchars($value['item']);
                            echo $ingredient . '<br>';
                        }
                        echo '</p><p>' . $directions . '</p><br>';
                    
                    
                }
                if (isset($_SESSION['username'])) {
                    echo '<input type="button" id="favrecipe" value="Add to Favorites"></input>';
                
                echo "<script>
                         $(document).ready(function(){
                             $('#addfav').click(function() {

                                 $.ajax({
                                     type: 'POST',
                                     url: 'addfavorite.php',
                                     data: { recipe_id:" . recipe_id . " },
                                     success: function(data){
                                         $('#addfav').after(\"<input type='button' value=\"Added to Favorites\"></input>\");
                                         $('#addfav').attr(\"type\", \"hidden\");
                                     }
                                 });

                             });
                         });
                    </script>";
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