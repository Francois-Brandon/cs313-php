<?php

    session_start();

    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $id = $_GET['id'];
    $action = $_GET['action']; 

    include 'cart-actions.php';

    $cartCount = 0;
    foreach($_SESSION['cart'] as $item) {
        $cartCount +=$item;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>DG Super Store</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<?php include 'header.php'; ?>
    

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Archon</div>
        <div class="panel-body"><img src="images/Star-Archon.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=archon&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Boss</div>
        <div class="panel-body"><img src="images/Star-Boss.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=boss&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Colossus</div>
        <div class="panel-body"><img src="images/Star-Colossus.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=colossus&action=add'>Add to cart</a></div>
      </div>
    </div>
  </div>
</div><br>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Daedalus</div>
        <div class="panel-body"><img src="images/Star-Daedalus.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=daedalus&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Orc</div>
        <div class="panel-body"><img src="images/Star-Orc.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=orc&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Valkyrie</div>
        <div class="panel-body"><img src="images/Star-Valkyrie.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=valkyrie&action=add'>Add to cart</a></div>
      </div>
    </div>
  </div>
</div><br><br>

<footer class="container-fluid text-center">
  <p>Copyright &copy;2018 Brandon Francois</p>
</footer>

</body>
</html>
