<?php
if($_POST["nom"] == ""){
    goto end;
}
session_start();
$_SESSION["NEW_ADDITION"] = TRUE;

include('../components/database_server.php');
$productInsert = $database->prepare("INSERT INTO client(client_name) VALUES (?)");

$productInsert->bind_param("s",$_POST["nom"]);
$productInsert->execute();

end:
$_POST = array();
header('Location: ../clients.php');
?>