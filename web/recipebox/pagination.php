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

    if (count > 2 && count % 3 == 0) {
        echo '</div><div class="row">';
    }
}

?>