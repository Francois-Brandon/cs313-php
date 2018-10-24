<?php

    try
    {
      $dbUrl = getenv('DATABASE_URL');

      $dbOpts = parse_url($dbUrl);

      $dbHost = $dbOpts["host"];
      $dbPort = $dbOpts["port"];
      $dbUser = $dbOpts["user"];
      $dbPassword = $dbOpts["pass"];
      $dbName = ltrim($dbOpts["path"],'/');

      $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $ex)
    {
      echo 'Error!: ' . $ex->getMessage();
      die();
    }

?>

<html>
<head>
    <title>Teach 05: Team Activity</title>
    <link rel="stylesheet" type="text/css" href="../mystyle.css">
</head>
<body>
    <h1>Add a Scripture</h1>
    

    
    <form action="results.php" method="post">
        
        <label for="book">Enter Book:</label>
        <input type="text" name="book"><br>
        
        <label for="chapter">Enter Chapter:</label>
        <input type="text" name="chapter"><br>
        
        <label for="verse">Enter Verse:</label>
        <input type="text" name="verse"><br>
        
        
        <?php 
            $stmt = $db->prepare('SELECT * FROM topic');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

            foreach ($rows as $value) {
                $topic = $value['name'];
                $id = $value['id'];
                
                echo '<input type="checkbox" name="' . $topic . $id .'" value="$topic"> $topic<br>';
            }
        
        
        ?>
        
        
        <button type="submit">Submit</button>
    
    </form>
    
</body>
</html>