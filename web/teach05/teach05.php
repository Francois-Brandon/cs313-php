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
        foreach ($db->query('SELECT book, chapter, verse, content FROM scriptures') as $row)
        {
          echo '<p><strong>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</strong> - ' . $row['content'];
          echo '<br/>';
        }
    ?>
    
</body>
</html>