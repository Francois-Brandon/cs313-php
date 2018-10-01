<html>
<head>
    <title>Teach 02: Team Activity</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    
</head>
<body>
    
    Name: <?php echo $_POST["name"]; ?><br>
    <?php $email = $_POST["email"];
    $sendEmail = "mailto:" . $_POST["email"];
    echo "Email: <a href=\"" . $email . "\">" . $email . "</a>" ?><br>
    Major: <?php echo $_POST["major"]; ?><br>
    Comments: <?php echo $_POST["comments"]; ?><br>
    
</body>
</html>