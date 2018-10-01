<html>
<head>
    <title>Teach 02: Team Activity</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    
</head>
<body>
    
    Name: <?php echo $_POST["name"]; ?><br>
    <?php $email = $_POST["email"];
    $sendEmail = "mailto:" . $_POST["email"];
    echo "Email: <a href=\"" . $sendEmail . "\">" . $email . "</a>" ?><br>
    Major: <?php echo $_POST["major"]; ?><br>
    
    <?php
        $visited = $_POST['continents'];
        if(empty($visited)) {
            echo("No continents selected. you must be from space.");
        }
        else {
            $N = count($visited);
            echo("Continents Visited: ");
            for($i=0; $i < $N; $i++) {
                echo($visited[$i] . " ");
            }
        }
    ?>

    
    Comments: <?php echo $_POST["comments"]; ?><br>
    
</body>
</html>