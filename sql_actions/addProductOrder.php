<?php
include('../components/database_server.php');
var_dump($_POST);
session_start();
$database->query("INSERT INTO product_order(id_orders,id_product,quantity,price,id_status_order_product) VALUES (".$_SESSION["order_id"].",".$_POST["products"].",".$_POST["quantity"].",".$_POST["price"].",".$_POST["product_order_status"].")");
header('Location: ../edit_orders.php');
?>