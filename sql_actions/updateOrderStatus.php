<?php
include('../components/database_server.php');
session_start();
$database->query("UPDATE orders SET id_orders_status = ".$_POST["orderStatus"]." WHERE id_orders =".$_SESSION["order_id"]);
header('Location: ../edit_orders.php');
?>