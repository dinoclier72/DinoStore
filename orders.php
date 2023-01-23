<?php
include("components/database_server.php");
$result = $database->query("SELECT * FROM commande_infos");
$table = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($table,$result->fetch_row());
}
$tableLength = count($table);
?>

<?php
function order_table($table){
    echo("<table id='tblToExcl'>");
    echo("<tr>");
    echo("<td>id_order</td>");
    echo("<td>order_status</td>");
    echo("<td>product_name</td>");
    echo("<td>quantity</td>");
    echo("<td>price</td>");
    echo("<td>status</td>");
    echo("</tr>");
    for($i=0;$i<count($table);$i++){
        //do something
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
                    <a href=""><button id="button" onclick="htmlTableToExcel('.xlsx')">EXPORTER EN EXCEL</button></a>
                </div>
                <div class = "orders_container">
                    <?php order_table($table);?>
                </div>
            </div>
        </div>
    </body>
</html>