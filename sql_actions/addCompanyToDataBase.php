<?php
var_dump($_POST);

if($_POST["nom"] == ""){
    echo("BRUH");
    goto end;
}

session_start();
$_SESSION["NEW_ADDITION"] = TRUE;

include('../components/database_server.php');
$productInsert = $database->prepare("INSERT INTO company(name) VALUES (?)");

$productInsert->bind_param("s",$_POST["nom"]);
$productInsert->execute();

end:
$_POST = array();
header('Location: ../products.php');
?>