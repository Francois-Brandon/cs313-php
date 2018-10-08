<?php
session_start();

include 'cart-actions.php';

$cartCount = 0;
    
?>

<!DOCTYPE html>
<html>
    <head>
    <title>DG Super Store - Order Confirmation</title>
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
    
<div class="container">
    
    <h1>Thank you for your order!</h1><br>
    
    <div class="row">
        
        <div class="col-sm-4">
            <p><?php echo htmlspecialchars($_POST['full_name']); ?></p>
            <p><?php echo htmlspecialchars($_POST['street1']); ?></p>
            <p><?php echo htmlspecialchars($_POST['street2']); ?></p>
            <p>
                <?php 
                    $city = htmlspecialchars($_POST['city']);
                    $state = htmlspecialchars($_POST['state']);
                    $zip = htmlspecialchars($_POST['zip']);
                    echo "$city, $state $zip";
                ?>
            </p>
        </div>
        
        <div class="col-sm-4">
            <?php
                foreach ($_SESSION['cart'] as $item) {
                    if ($item['quantity'] != 0) {
                        $name = $item['name'];
                        $id = strtolower($item['name']);
                        $price = $item['price'];
                        $img = $item['img'];
                        $quantity = $item['quantity'];
                        $subtotal = $price * $quantity;

                        echo "<p>$name x$quantity - $$subtotal</p>";
                    }
                }
            ?>
        </div>
        
        <div class="col-sm-4">
            <p>Total: $<?php echo $_SESSION['total'];?></p>
        </div>
        
    </div>
        
</div>
    
    
    
    
<footer class="container-fluid text-center">
  <p>Copyright &copy;2018 Brandon Francois</p>
</footer>

</body>
</html>