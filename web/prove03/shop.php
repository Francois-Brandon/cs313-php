<?php

    session_start();

    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

$id = $_GET['id'];
$action = $_GET['action']; 

switch($action) { 

    case "add":
        $_SESSION['cart'][$id]++; 
    break;

    case "remove":
        $_SESSION['cart'][$id]--;
        if($_SESSION['cart'][$id] == 0) unset($_SESSION['cart'][$id]);
    break;

    case "empty":
        unset($_SESSION['cart']); 
    break;

}

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

<div class="jumbotron">
  <div class="container text-center">
      <h1 class="logo-name">Disc Golf<br>Super Store</h1>    
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="items.html"><p><img src="images/dgicon.png" alt="dgicon"  width="30px" class="logo-img"> Products</p></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!--<li class="active"><a href="#">Home</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Contact</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart cart-icon"></span><span class="cart"> Cart (<?php echo $cartCount ?>)</span></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Disc #1</div>
        <div class="panel-body"><img src="images/Star-Archon.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=archon&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Disc #2</div>
        <div class="panel-body"><img src="images/Star-Boss.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=boss&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Disc #3</div>
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
        <div class="panel-heading">Disc #4</div>
        <div class="panel-body"><img src="images/Star-Daedalus.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=daedalus&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Disc #5</div>
        <div class="panel-body"><img src="images/Star-Orc.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=orc&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Disc #6</div>
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
