<?php
include("../components/database_server.php");
$querry = "UPDATE socials SET type = '".$_POST["social_type"]."',social_name ='".$_POST["social_name"]."' WHERE id_socials = ".$_POST["id_social"];
$database->query($querry);
header('Location: ../edit_client.php');
?>