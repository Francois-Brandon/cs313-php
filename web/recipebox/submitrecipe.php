<?php require 'res/db.php'; ?>

<html lang="en">
<head>
    <title>Recipe Box - Submit Recipe</title>
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
	<div class="row">
        <div class="control-group" id="fields">
            <label class="control-label" for="field1">Ingredients</label>
            <div class="controls"> 
                <form role="form" autocomplete="off">
                    <div class="entry input-group col-xs-3">
                        <input class="form-control" name="fields[]" type="text" placeholder="1 Cup Sugar" />
                    	<span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                </form>
            <br>
            </div>
        </div>
	</div>
</div>
    
    
    
    
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform">
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active">Ingredients</li>
                <li>Directions</li>
                <li>Image</li>
            </ul>
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title">Ingredients</h2>
                <h3 class="fs-subtitle">Enter the ingredients for your recipe</h3>
                <div class="entry input-group col-xs-3">
                        <input class="form-control" name="fields[]" type="text" placeholder="1 Cup Sugar"/>
                    	<span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div>
                <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Directions</h2>
                <h3 class="fs-subtitle">Enter the directions for your recipe</h3>
                <textarea name="input-directions" rows="20" cols="100" placeholder="Directions"></textarea>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="button" name="next" class="next action-button" value="Next"/>
            </fieldset>
            <fieldset>
                <h2 class="fs-title">Upload Image</h2>
                <h3 class="fs-subtitle">Select image to upload</h3>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                <input type="submit" name="submit" class="submit action-button" value="Submit"/>
            </fieldset>
        </form>
    </div>
</div>

    
   <?php
        //foreach ($db->query('SELECT * FROM scriptures') as $row)
        //{
        //  echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong> //- "' . $row['content'] . '"';
        //  echo '</p>';
        //}
    ?>
    
<?php require 'res/footer.php'; ?>
    
</body>
</html>