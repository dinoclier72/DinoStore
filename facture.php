<?php
include("components/database_server.php");
session_start();
$result = $database->query("SELECT DISTINCT client_name FROM commande_info WHERE id_orders = ".$_SESSION["order_id"]);
$client = $result->fetch_row()[0];

$productRecap = [];
$result = $database->query("SELECT product_name,quantity,price FROM commande_info WHERE id_orders = ".$_SESSION["order_id"]);
for($i=0;$i<$result->num_rows;$i++){
    array_push($productRecap,$result->fetch_row());
}

function RecapTable($productTable){
    $prixFinal = 0;
    $len = count($productTable);
    echo("<table>
        <td>No</td>
        <td>produit</td>
        <td>quantite</td>
        <td>prix unite</td>
        <td>prix total</td>");
    for($i=0;$i<$len;$i++){
        $total = $productTable[$i][2]*$productTable[$i][2];
        $prixFinal += $total;
        echo("<tr>
            <td>".($i+1)."</td>
            <td>".$productTable[$i][0]."</td>
            <td>".$productTable[$i][1]."</td>
            <td>".$productTable[$i][2]."</td>
            <td>".$total."</td>");
    }
    echo("</table>");
    return $prixFinal;
}
?>

<html>
    <head>
        <title>La facture - DinoStore</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <?php include './components/header.php' ?>
        <link rel="stylesheet" href="css/table_effect.css">
    </head>
    <body>
        <?php include './components/sidebar.php' ?>
        <div class = "content">
            <div class = "title">
                <?php include('./components/client_title.php')?>
            </div>
            <div class = "bar"></div>
            <div class = "all_the_content" id ="facture">
                <p>DinoStore</p>
                <?php
                echo("<p>Facture pour :".$client."</p>");
                $prixFinal = RecapTable($productRecap);
                echo("<p>Montant de la commande:".$prixFinal."</p>");
                echo("<p>frais de service: 0</p>");
                echo("<p>frais de livraison: 0</p>");
                echo("<p>Montant de la promotion: 0</p>");
                echo("<p>depot: 0</p>");
                echo("<p>Montant de la facture: ".$prixFinal."</p>");
                ?>
            </div>
            <button onclick="printToPdf()">IMPRIMER</button>
        </div>
        <script>
            function printToPdf(){
                var element = document.getElementById("facture");
                html2pdf(element);
            }
        </script>
    </body>
</html>