<?php

$id = $_GET['id'];
$action = $_GET['action']; 

switch($action) { 

    case "add":
        $_SESSION['cart'][$id]['quantity']++; 
    break;

    case "remove":
        $_SESSION['cart'][$id]['quantity']--;
        if($_SESSION['cart'][$id]['quantity'] < 0) $_SESSION['cart'][$id]['quantity'] = 0;
    break;

    case "empty":
        foreach ($_SESSION['cart'] as $item) {
            $item['quantity'] = 0;
        }

    break;

}

?>