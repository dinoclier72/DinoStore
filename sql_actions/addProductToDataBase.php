<?php
var_dump($_POST);

if($_POST["nom"] == ""){
    echo("BRUH");
    goto end;
}

session_start();
$_SESSION["NEW_ADDITION"] = TRUE;

include('../components/database_server.php');
$productInsert = $database->prepare("INSERT INTO product(product_name,id_company) VALUES (?,?)");

$fetchCompanyId = $database->prepare("SELECT id_company FROM company WHERE company_name = ?");
$fetchCompanyId->bind_param("s",$_POST["Companies"]);
$fetchCompanyId->execute();
$fetchCompanyId->store_result();
$fetchCompanyId->bind_result($result);
$fetchCompanyId->fetch();

$productInsert->bind_param("si",$_POST["nom"],$result);
$productInsert->execute();

end:
$_POST = array();
header('Location: ../products.php');
?>