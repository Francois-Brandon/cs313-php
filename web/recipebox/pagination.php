<?php

require 'res/db.php'; 
session_start();

$pageno = $_POST['pageno'];

$no_of_records_per_page = 12;
$offset = ($pageno-1) * $no_of_records_per_page;


$stmt = $db->prepare('SELECT c.username AS username, r.recipe_id AS recipe_id, r.recipe_name AS recipe_name, r.directions AS directions, r.date_created FROM recipe AS r JOIN login AS c ON r.user_id = c.id ORDER BY r.date_created DESC LIMIT :records OFFSET :offset');
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':records', $no_of_records_per_page, PDO::PARAM_INT);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
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

    foreach ($rows as $value) {
        $ingredients .= htmlspecialchars($value['item']) . '<br>';
    }

    $stmt = $db->prepare('SELECT COUNT(stars), AVG(stars) FROM rating WHERE recipe_id = :recipe_id');
    $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
    $stmt->execute();
    $ratingrows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($ratingrows as $rate) {
        $avgnon = $rate['avg'];
        $avg = floor($avgnon * 2) / 2;
        $numratings = $rate['count'];
    }

        echo '<div class="col-sm-4">';
            echo '<div class="panel panel-primary">';
                echo '<div class="panel-heading">' . $recipe_name; 
                    if ($numratings == 0) {
                        echo '<p>no ratings</p></div>';
                    }
                    else {
                        echo '<div class="star-ratings-css" title="' . $avg . '"></div></div>';
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

    if (count > 2 && count % 3 == 0) {
        echo '</div><div class="row">';
    }
}

?>