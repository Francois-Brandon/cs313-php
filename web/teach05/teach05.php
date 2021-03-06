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
    <h1>Scripture Resources</h1>
    
    <?php
    $statement = $db->prepare("SELECT book, chapter, verse, content FROM scripture");
    $statement->execute();
    
    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
        {

            echo '<p>';
            echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':';
            echo $row['verse'] . '</strong>' . ' - ' . $row['content'];
            echo '</p>';
        }
    ?><br>
    
    <form action="results.php" method="post">
        
        <label for="book">Enter Book:</label>
        <input type="text" name="book"><br>
        <button type="submit">Search</button>
    
    </form>
    
</body>
</html>