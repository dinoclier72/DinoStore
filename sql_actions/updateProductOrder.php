<?php
include('../components/database_server.php');
var_dump($_POST);
session_start();
$database->query("UPDATE product_order SET quantity = ".$_POST["quantity"].",price = ".$_POST["price"].",id_status_order_product =".$_POST["productOrderStatus"]." WHERE id_product = ".$_POST["product_id"]." AND id_orders = ".$_SESSION["order_id"]);
header('Location: ../edit_orders.php');
?>