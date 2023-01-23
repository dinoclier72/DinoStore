<?php
session_start();
if(isset($_POST["order_id"])){
    $_SESSION["order_id"] = $_POST["order_id"];
    $_POST = array();
}
include("components/database_server.php");
$result = $database->query("SELECT client_name,id_orders_status FROM orders NATURAL JOIN client WHERE id_orders =".$_SESSION["order_id"]);
$table = $result->fetch_row();

$result = $database->query("SELECT id_product,product_name,quantity,price,id_status_order_product FROM product_order NATURAL JOIN product WHERE id_orders=".$_SESSION["order_id"]);
$sub_table = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($sub_table,$result->fetch_row());
}
array_push($table,$sub_table);
//var_dump($table);

$result = $database->query("SELECT id_orders_status,order_status_name FROM orders_status ORDER BY id_orders_status");
$orderStatusList = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($orderStatusList,$result->fetch_row());
}

$result = $database->query("SELECT id_status_order_product,status_order_product_name FROM status_order_product ORDER BY id_status_order_product");
$ProductorderStatusList = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($ProductorderStatusList,$result->fetch_row());
}

$lstID = "(";
for($i=0;$i<count($table[2]);$i++){
    $lstID .= $table[2][$i][0];
    if($i<count($table[2])-1){
        $lstID .= ",";
    }
}
$lstID .= ")";
if($lstID == "()"){
    $lstID = "(-1)";
}
$result = $database->query("SELECT id_product,product_name FROM product WHERE id_product NOT IN ".$lstID."ORDER BY id_product");
$AvailableProductList = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($AvailableProductList,$result->fetch_row());
}

function dropdownSelectOne($List,$selected,$Name){
    echo("<select name='".$Name."'>");
    for($i=0;$i<count($List);$i++){
        if($i == $selected){
            $addition = "selected";
        }else{
            $addition ="";
        }
        echo("<option value=".$List[$i][0]." ".$addition.">".$List[$i][1]."</option>");
    }
    echo("</select>");
}
?>

<html>
    <head>
        <title>Ajouts de clients - DinoStore</title>
        <?php include './components/header.php' ?>
    </head>
    <body>
        <?php include './components/sidebar.php' ?>
        <div class = "content">
            <div class = "title">
                <?php include('./components/client_title.php')?>
            </div>
            <div class = "bar"></div>
            <div class = "all_the_content">
                <?php 
                    echo("<input disabled = 'disabled' value ='".$table[0]."'><br>");
                    echo("<form action = 'sql_actions/updateOrderStatus.php' method = 'post'>
                    <input type = 'hidden' value = ".$table[1].">");
                    dropdownSelectOne($orderStatusList,$table[1]-1,'orderStatus');
                    echo("<button>MODIFIER</button></form>");
                    $product_orders = $table[2];
                    for($i=0;$i<count($product_orders);$i++){
                        echo("<form method = 'post' action = 'sql_actions/updateProductOrder.php'>
                                <input name ='product_id' type ='hidden' value = ".$product_orders[$i][0].">
                                <input disabled = 'disabled' value= '".$product_orders[$i][1]."'>
                                <input name ='quantity' value = ".$product_orders[$i][2].">
                                <input name ='price' value = ".$product_orders[$i][3].">");
                        dropdownSelectOne($ProductorderStatusList,$product_orders[$i][4]-1,"productOrderStatus");
                        echo("<button>EDIT</button>
                            </form>");
                    }
                    echo("<form method = 'post' action = 'sql_actions/addProductOrder.php'>
                        <input type = 'hidden' value = ".$_SESSION["order_id"].">");
                    dropdownSelectOne($AvailableProductList,0,'products');
                    echo("<input name = 'quantity'>
                    <input name = 'price'>");
                    dropdownSelectOne($ProductorderStatusList,0,'product_order_status');
                    echo("<button>ADD</button>
                    </form>");
                ?>
                <button>FACTURE</button>        
            </div>
        </div>
    </body>
</html>