<?php
include("../components/database_server.php");
session_start();
$database->query("INSERT INTO socials(id_client) VALUES (".$_SESSION["clientID"].")");
header('Location: ../edit_client.php');
?>