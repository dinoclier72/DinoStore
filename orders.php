<?php
include("components/database_server.php");
$result = $database->query("SELECT DISTINCT id_orders,client_name,order_status_name FROM commande_info");
$table = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($table,$result->fetch_row());
    $subResult = $database->query("SELECT product_name,quantity,price,status_order_product_name FROM commande_info");
    $subTable = [];
    for($j=0;$j<$subResult->num_rows;$j++){
        array_push($subTable,$subResult->fetch_row());
    }
    array_push($table[$i],$subTable);
}
$tableLength = count($table);
?>

<?php
function order_table($table){
    echo("<table id='tblToExcl'>");
    echo("<tr>");
    echo("<td>id_order</td>");
    echo("<td>client_name</td>");
    echo("<td>order_status</td>");
    echo("<td>product_name</td>");
    echo("<td>quantity</td>");
    echo("<td>price</td>");
    echo("<td>status</td>");
    echo("</tr>");
    for($i=0;$i<count($table);$i++){
        $current_order = $table[$i];
        $order_size = count($current_order[3]);
        echo("<tr>");
        echo("<td rowspan = '".$order_size."'>".$current_order[0]."</td>");
        echo("<td rowspan = '".$order_size."'>".$current_order[1]."</td>");
        echo("<td rowspan = '".$order_size."'>".$current_order[2]."</td>");
        for($j=0;$j<$order_size;$j++){
            if($j>0){
                echo("<tr>");
            }
            echo("<td>".$current_order[3][$j][0]."</td>");
            echo("<td>".$current_order[3][$j][1]."</td>");
            echo("<td>".$current_order[3][$j][2]."</td>");
            echo("<td>".$current_order[3][$j][3]."</td>");
            echo("</tr>");
        }
        echo("</tr>");
    }
    echo("</table>");
}
?>
<html>
    <head>
        <title>Le DinoStore</title>
        <?php include './components/header.php' ?>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <script type="text/javascript" src="js/htmlTableToExcel.js"></script>
    </head>
    <body>
        <?php include './components/sidebar.php' ?>
        <div class = "content">
            <div class = "title">
                <?php include('./components/order_title.php')?>
            </div>
            <div class = "bar"></div>
            <div class = "all_the_content">
                <div class = "general_commands">
                    <form action="" method = "post">
                        <input type="text" placeholder = "commande" class="search_bar" name="recherche">
                        <input type="submit">
                    </form>
                    <a href="add_order.php"><button>+</button></a>
                    <button id="button" onclick="htmlTableToExcel('xlsx')">EXPORTER EN EXCEL</button>
                </div>
                <div class = "orders_container">
                    <?php order_table($table);?>
                </div>
            </div>
        </div>
    </body>
</html>