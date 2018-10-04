<?php

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

?>