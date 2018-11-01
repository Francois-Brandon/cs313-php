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
    
<form action="search.php" method="post">
    <div class="container search-container">
        <div class="row">
            <div class="col-md-12">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="recipe-search" class="form-control input-lg" placeholder="Search for a recipe by keyword" />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-lg" type="button">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</form>
    
<div class="container recipe-container"> 
    
  <div class="row">
      <h1>Recent Recipe Submissions</h1>

      <div id="response">
   <?php
        $count = 1;
      
        foreach ($db->query('SELECT c.username AS username, r.recipe_id AS recipe_id, r.recipe_name AS recipe_name, r.directions AS directions, r.date_created FROM recipe AS r JOIN login AS c ON r.user_id = c.id ORDER BY r.date_created DESC LIMIT 12') as $row)
        {
            $recipe_name = htmlspecialchars($row['recipe_name']);
            $recipe_id = htmlspecialchars($row['recipe_id']);
            $ingredients = '';
            $directions = htmlspecialchars($row['directions']);
            
            $avg = 0;
            $numratings = 0;
            
            $stmt = $db->prepare('SELECT item FROM ingredients WHERE recipe_id=:recipe_id');
            $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($rows as $value)
            {
                $ingredients .= htmlspecialchars($value['item']) . '<br>';
            }
            
            $stmt = $db->prepare('SELECT COUNT(stars), AVG(stars) FROM rating WHERE recipe_id = :recipe_id');
            $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
            $stmt->execute();
            $ratingrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($ratingrows as $rate) {
                $avg = $rate['avg'];
                $numratings = $rate['count'];
            }
            
            

                echo '<div class="col-sm-4">';
                    echo '<div class="panel panel-primary">';
                        echo '<div class="panel-heading">' . $recipe_name; 
                            if ($numratings == 0) {
                                echo '<p>no ratings</p></div>';
                            }
                            else {
                                echo '<br><div class="star-ratings-css" title="' . $avg . '"></div>';
                            }
                        echo '<div class="panel-body">' . $ingredients . '</div>';
                        echo '<div class="panel-footer">
                        <form role="form" autocomplete="off" action="recipedetails.php" method="post" enctype="multipart/form-data" class="details-form">
                        <input type="hidden" name="recipe_id" value="' . $recipe_id . '">
                            <input type="submit" name="submit" class="submit action-button details-btn" value="See More"/>
                        </form>
                        </div>';
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
            
            if (count > 2 && count % 3 == 0) {
                echo '</div><div class="row">';
            }
        }
    ?>
      </div>
      <input type="hidden" id="pageno" value="1">
      <div>
        <img id="loader" src="res/loader.svg">
      </div>
        <script>
    
         $(document).ready(function(){
             $('#loader').on('inview', function(event, isInView) {
                 if (isInView) {
                     $('#loader').show();
                     var nextPage = parseInt($('#pageno').val())+1;
                     $.ajax({
                         type: 'POST',
                         url: 'pagination.php',
                         data: { pageno: nextPage },
                         success: function(data){
                             $('#response').append(data);
                             $('#pageno').val(nextPage);
                             $('#loader').hide();
                         }
                     });
                 }
             });
         });
        </script>
    </div>
</div>
    
<?php require 'res/footer.php'; ?>
    
</body>
</html>