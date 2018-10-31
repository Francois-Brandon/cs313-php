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
    <link rel="stylesheet" href="res/star-rating.min.css">
    <link rel="stylesheet" type="text/css" href="recipe-style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inview/1.0.0/jquery.inview.min.js"></script>
    <script src="res/star-rating.min.js" type="text/javascript"></script>
</head>
<body>
    
<?php require 'res/nav.php'; ?>
    
    
    
<div class="container results-container">
	<div class="submit-panel">
        
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

            $stmt = $db->prepare('SELECT COUNT(stars), AVG(stars) FROM rating WHERE recipe_id = :recipe_id');
            $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
            $stmt->execute();
            $ratingrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($ratingrows as $rate) {
                $avg = $rate['avg'];
                $count = $rate['count'];
            

            echo '<div class="row"><h3>' . $recipe_name . '</h3></div>';
            
            echo '<div class="row"><table>
                      <tr>
                        <td style="padding-right:10px">
                          <label for="star-input" class="control-label">Rating: </label>
                        </td>
                        <td>
                          <input id="star-input" name="star-input" value="' . $avg . '" class="rating">
                        </td>
                        <td><label class="control-label">' . $count . '   Reviews</label></td>
                      </tr>
                    </table>
                <script>
                $(document).on(\'ready\', function(){
                    $(\'#star-input\').rating({displayOnly: true, step: 0.5, showCaption: false});
                });
                </script></div>';
                
                }
            
            echo '<div class="row"><p>';
            
            $stmt = $db->prepare('SELECT item FROM ingredients WHERE recipe_id=:recipe_id');
            $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($rows as $value) {
                $ingredient = htmlspecialchars($value['item']);
                echo $ingredient . '<br>';
            }
            
            echo '</p></div><div class="row"><p>' . $directions . '</p></div><br>';


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

            echo '<div class="row">';

            $query = 'SELECT * FROM favorites WHERE recipe_id = :recipe_id AND user_id = :user_id';
            $statement = $db->prepare($query);
            $statement->bindValue(':recipe_id', $recipe_id);
            $statement->bindValue(':user_id', $user_id);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);


            if (count($rows)) {
                echo '<div class="details-options"><form role="form" class="fav-form"><input type="hidden" id="addfav" value="Add to Favorites" class="btn btn-default fav-btn">
                <input type="button" id="removefav" value="Remove From Favorites" class="btn btn-default fav-btn"></input></form>';
            } else {
                echo '<div class="details-options"><form role="form" class="fav-form"><input type="button" id="addfav" value="Add to Favorites" class="btn btn-default fav-btn">
                <input type="hidden" id="removefav" value="Remove From Favorites" class="btn btn-default fav-btn"></input></form>';
            }

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

        echo "</div><script>
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
                             url: 'removefavorite.php',
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

<div class="container results-container">
	<div class="submit-panel">
        <form role="form" autocomplete="off" action="submitreview.php" method="post" enctype="multipart/form-data">
            <div class="row"><h3>Submit a Review</h3></div>
            <div class="row">
                <label for="review-rating" class="control-label">Rating</label>
                <input id="review-rating" class="rating" value="0" data-min="0" data-max="5" data-step="1" data-size="lg"><hr/>
            </div>
            <input type="submit" name="submit" class="submit action-button btn-default" value="Submit"/><input type="reset" name="reset" class="submit action-button btn-default" value="Reset"/>
        </form>
    </div>
</div>
    
<script>
    $(document).on('ready', function(){
        $('#review-rating').rating();
    });
</script>
    
<?php require 'res/footer.php'; ?>
    
</body>
</html>