<?php
include('../components/database_server.php');
var_dump($_POST);
$database->query("INSERT INTO orders(id_orders_status,id_client) VALUES (1,".$_POST["clients"].")");
header('Location: ../orders.php');
?>