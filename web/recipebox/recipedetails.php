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
                $recipe_user = '';

                $query = 'SELECT r.recipe_name, r.directions, r.user_id, l.username FROM recipe AS r JOIN login AS l ON r.user_id = l.id WHERE r.recipe_id = :recipe_id';
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
                
                $query = 'SELECT id FROM login WHERE username = :username';
                $statement = $db->prepare($query);
                $statement->bindValue(':username', $username);
                $statement->execute();
                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);


                foreach ($rows as $row) {
                    $user_id = $row['id'];
                }
                
                if (isset($_SESSION['username'])) {
                    
                    echo '<div class="details-options"><form role="form" class="fav-form"><input type="button" id="addfav" value="Add to Favorites" class="btn btn-default fav-btn">
                    <input type="hidden" id="removefav" value="Remove From Favorites" class="btn btn-default fav-btn"></input></form>';
                    if($recipe_user == $username) {
                    echo '<form role="form" class="delete-form" autocomplete="off" action="deleterecipe.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="recipe_id" value="' . $recipe_id . '">
                                <button type="submit" class="btn btn-default">Delete</button>
                            </form>
                            <form role="form" class="edit-form" autocomplete="off" action="editrecipe.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="recipe_id" value="' . $recipe_id . '">
                                <button type="submit" class="btn btn-default">Edit</button>
                            </form></div>';
                    }
                
                echo "<script>
                         $(document).ready(function(){
                             $('#addfav').click(function() {

                                 $.ajax({
                                     type: 'POST',
                                     url: 'addfavorite.php',
                                     data: { recipe_id:" . $recipe_id . " },
                                     success: function(data){
                                         $('#addfav').attr(\"type\", \"hidden\");
                                         $('#removefav').attr(\"type\", \"button\");
                                     }
                                 });

                             });
                         });
                         
                         $(document).ready(function(){
                             $('#removefav').click(function() {

                                 $.ajax({
                                     type: 'POST',
                                     url: 'addfavorite.php',
                                     data: { recipe_id:" . $recipe_id . " },
                                     success: function(data){
                                         $('#removefav').attr(\"type\", \"hidden\");
                                         $('#addfav').attr(\"type\", \"button\");
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