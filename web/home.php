<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Home Page</title>
</head>
<body>
    <div id="nav-placeholder">
    </div>

    <script>
        $(function(){
        $("#nav-placeholder").load("nav.html");
         });
     </script>
    
    <div class="container-fluid text-center">
        <p>Browse for information about my interests and assignments.</p>
    </div>
    
    
    <footer class="container-fluid bg-4 text-center">
        <?php include 'footer.php';?> 
    </footer>

</body>
</html>
