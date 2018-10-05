<?php
session_start();

include 'cart-actions.php';

    $cartCount = 0;
    foreach($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity']; 
    }

?>
<!DOCTYPE html>
<html>
    <head>
    <title>DG Super Store - Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    

<?php include 'header.php';?>
    
    
    
    
    
    
<footer class="container-fluid text-center">
  <p>Copyright &copy;2018 Brandon Francois</p>
</footer>

</body>
</html>