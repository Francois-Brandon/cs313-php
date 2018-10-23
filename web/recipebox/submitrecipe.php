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
    
<!--<div class="container results-container">
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
</div>-->
    
<div class="container results-container">
   <form id="regForm" action="">

        <h1>Register:</h1>

        <!-- One "tab" for each step in the form: -->
        <div class="tab">Name:
          <p><input placeholder="First name..." oninput="this.className = ''"></p>
          <p><input placeholder="Last name..." oninput="this.className = ''"></p>
        </div>

        <div class="tab">Contact Info:
          <p><input placeholder="E-mail..." oninput="this.className = ''"></p>
          <p><input placeholder="Phone..." oninput="this.className = ''"></p>
        </div>

        <div class="tab">Birthday:
          <p><input placeholder="dd" oninput="this.className = ''"></p>
          <p><input placeholder="mm" oninput="this.className = ''"></p>
          <p><input placeholder="yyyy" oninput="this.className = ''"></p>
        </div>

        <div class="tab">Login Info:
          <p><input placeholder="Username..." oninput="this.className = ''"></p>
          <p><input placeholder="Password..." oninput="this.className = ''"></p>
        </div>

        <div style="overflow:auto;">
          <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
          </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>

    </form>
</div>
    
<!--    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form id="msform">

            <ul id="progressbar">
                <li class="active">Ingredients</li>
                <li>Directions</li>
                <li>Image</li>
            </ul>
            
            <fieldset>
                <h2 class="fs-title">Ingredients</h2>
                <h3 class="fs-subtitle">Enter the ingredients for your recipe</h3>
                
                        <input class="form-control" name="fields[]" type="text" placeholder="1 Cup Sugar"/>
                    	<span class="input-group-btn">
                            <button class="btn btn-success btn-add" type="button">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    
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
</div>-->

    
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