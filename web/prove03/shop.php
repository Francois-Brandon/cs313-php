<?php

    session_start();

    if (empty($_SESSION['cart'])) {
        $_SESSION['cart'] = array(
        'archon' => array('price' => 10.99, 'quantity' => 0, 'img' => 'images/Star-Archon.jpg', 'name' => 'Archon', 'description' => 'The Archon is a new Speed 11 Distance Driver that blends the graceful long turn of the Katana with the smooth fade of a Wraith. It has been described as a longer Valkyrie. This is the disc for players looking to master their game and rule the course.'),
        'boss' => array('price' => 12.99, 'quantity' => 0, 'img' => 'images/Star-Boss.jpg', 'name' => 'Boss', 'description' => 'This is a fast stable driver that can handle full power throws and moderate headwinds. Advanced players and sidearm throwers will appreciate the dependable stability. The Boss has a slight high speed turn to help maximize distance with a predictable fade.'),
        'colossus' => array('price' => 14.99, 'quantity' => 0, 'img' => 'images/Star-Colossus.jpg', 'name' => 'Colossus', 'description' => 'The Colossus is a max distance driver with predictable high speed turn and reliable fade. Although it has a wide rim, it is also relatively easy to hold and throw both backhand and forehand. If you\'ve wanted to throw a really fast driver, but couldn\'t quite handle the wide rim, try the Colossus.'),
        'daedalus' => array('price' => 12.99, 'quantity' => 0, 'img' => 'images/Star-Daedalus.jpg', 'name' => 'Daedalus', 'description' => ''),
        'orc' => array('price' => 10.99, 'quantity' => 0, 'img' => 'images/Star-Orc.jpg', 'name' => 'Orc', 'description' => 'The Orc is one of our most popular, straight flying distance drivers. It combines speed with accuracy for very long range, predictable flights. Great for straight ahead power shots and long hyzer shots. Suitable for powerful throwers, but still manageable by beginners in lighter weights.'),
        'valkyrie' => array('price' => 12.99, 'quantity' => 0, 'img' => 'images/Star-Valkyrie.jpg', 'name' => 'Valkyrie', 'description' => 'In lighter weights gives new players extra distance. Lighter weights also give players extreme range when thrown downwind, while maximum weights can give excellent upwind distance. The Valkyrie’s high speed turn and flight characteristics make it great choice for long range turnover shots and rollers.')
        );
    }

    $id = $_GET['id'];
    $action = $_GET['action']; 

    include 'cart-actions.php';

    $cartCount = 0;
    foreach($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
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
        <div class="panel-heading">Archon - $10.99</div>
          <div class="panel-body"><a data-toggle="modal" href="#myModal"><img src="images/Star-Archon.jpg" class="img-responsive" style="width:100%" alt="Image"></a></div>
        <div class="panel-footer"><a href='shop.php?id=archon&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Boss - $12.99</div>
        <div class="panel-body"><img src="images/Star-Boss.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=boss&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Colossus - $14.99</div>
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
        <div class="panel-heading">Daedalus - $12.99</div>
        <div class="panel-body"><img src="images/Star-Daedalus.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=daedalus&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Orc - $10.99</div>
        <div class="panel-body"><img src="images/Star-Orc.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=orc&action=add'>Add to cart</a></div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-primary">
        <div class="panel-heading">Valkyrie - $12.99</div>
        <div class="panel-body"><img src="images/Star-Valkyrie.jpg" class="img-responsive" style="width:100%" alt="Image"></div>
        <div class="panel-footer"><a href='shop.php?id=valkyrie&action=add'>Add to cart</a></div>
      </div>
    </div>
  </div>
</div><br><br>
    
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright &copy;2018 Brandon Francois</p>
</footer>

</body>
</html>
