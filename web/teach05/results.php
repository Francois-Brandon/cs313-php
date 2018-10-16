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
    <title>Teach 02: Team Activity</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body>
    <h1>Scripture Resources</h1>
    
    <?php
    $book = $_POST['book'];
    
        foreach ($db->query('SELECT * FROM scriptures WHERE book = \'' . $book . '\'') as $row)
        {
          echo '<a href="details.php?id=' . $id . '><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong></a>';
          echo '<br/>';
        }
    ?>
    

    
</body>
</html>