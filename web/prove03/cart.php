<?php
session_start();

include 'cart-actions.php';

$_SESSION['total'] = 0;

    $cartCount = 0;
    foreach($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity']; 
    }

?>
<!DOCTYPE html>
<html>
    <head>
    <title>DG Super Store - Cart</title>
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
	<table id="cart" class="table table-hover table-condensed">
    				<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
					<tbody>
                        

						<?php
                        foreach ($_SESSION['cart'] as $item) {
                            if ($item['quantity'] != 0) {
                                $name = $item['name'];
                                $id = strtolower($item['name']);
                                $price = $item['price'];
                                $img = $item['img'];
                                $quantity = $item['quantity'];
                                $subtotal = $price * $quantity;
                                $_SESSION['total'] = $subtotal;
                                echo "<tr>
                                    <td data-th=\"Product\">
                                        <div class=\"row\">
                                            <div class=\"col-sm-2 hidden-xs\"><img src=\"$img\" alt=\"...\" class=\"img-responsive\"/></div>
                                            <div class=\"col-sm-10\">
                                                <h4 class=\"nomargin\">$name</h4>
                                                <p>Description</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th=\"Price\">$price</td>
                                    <td data-th=\"Quantity\">$quantity</td>
                                    <td data-th=\"Subtotal\" class=\"text-center\">$subtotal</td>
                                    <td class=\"actions\" data-th=\"\">
                                        <a  href=\"cart.php?id=$id&action=empty\" class=\"\"><i class=\"fa fa-trash-o\"></i></a>								
                                    </td>
                                </tr>";
                            }
                        }
                        ?>
                        
                        
					</tbody>
        
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>What is this</strong></td>
						</tr>
						<tr>
							<td><a href="shop.php" class="btn btn-continue"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong><?php
                                    $total = 0.00;
                                    foreach ($_SESSION['cart'] as $item) {
                                        $total += $item['price'] * $item['quantity'];
                                    }
                                    echo "Total $$total";
                                ?></strong></td>
							<td><a href="checkout.php" class="btn btn-success btn-checkout">Checkout <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
</div>
    
<footer class="container-fluid text-center">
  <p>Copyright &copy;2018 Brandon Francois</p>
</footer>

</body>
</html>