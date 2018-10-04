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
    <title>DG Super Store - Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    

<?php
    include 'header.php';
    print_r($_SESSION);
?>
    
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
                        
                        <? php
                        foreach ($_SESSION['cart'] as $item) {
                            if ($item['quantity'] != 0) {
                                $img = $item['img'];
                                $name = $item['name'];
                                $price = $item['price'];
                                $quantity = $item['quantity'];
                                $subtotal = $quantity * $price;
                                echo "<tr>
                                   <td data-th=\"Product\">
                                      <div class=\"row\">
                                         <div class=\"col-sm-2 hidden-xs\"><img src=\"$img\" alt=\"...\" class=\"img-responsive\"/></div>
                                         <div class=\"col-sm-10\">
                                            <h4 class=\"nomargin\">$name</h4>
                                            <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                                         </div>
                                      </div>
                                   </td>
                                   <td data-th=\"Price\">$$price</td>
                                   <td data-th=\"Quantity\">
                                      <input type=\"number\" class=\"form-control text-center\" value=\"$quantity\">
                                   </td>
                                   <td data-th=\"Subtotal\" class=\"text-center\">$subtotal</td>
                                   <td class=\"actions\" data-th=\"\">
                                      <button class=\"btn btn-info btn-sm\"><i class=\"fa fa-refresh\"></i></button>
                                      <button class=\"btn btn-danger btn-sm\"><i class=\"fa fa-trash-o\"></i></button>								
                                   </td>
                                </tr>"
                            }
                        }
						
                        ?>
					</tbody>
        
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>Total 1.99</strong></td>
						</tr>
						<tr>
							<td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							<td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
							<td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
						</tr>
					</tfoot>
				</table>
</div>

</body>
</html>