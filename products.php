<?php
include("components/database_server.php");
$result = $database->query("SELECT product_name,company_name FROM product NATURAL JOIN company ORDER BY company_name");
$table = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($table,$result->fetch_row());
}
$tableLength = count($table);
?>

<?php
    function ProductCard($product_name,$company_name){
        echo("
        <div class = 'productCard'>
            <p>".$product_name."</p>
            <p>".$company_name."</p>
            <button>edit</button>
        </div>
        ");
    }
?>

<html>
    <head>
        <title>Le DinoStore</title>
        <?php include './components/header.php' ?>
        <link rel="stylesheet" href="css/produits.css">
    </head>
    <body>
        <?php include './components/sidebar.php' ?>
        <div class = "content">
            <div class = "title">
                <?php include('./components/product_title.php')?>
            </div>
            <div class = "bar"></div>
            <div class = "all_the_content">
                <div class = "general_commands">
                    <form action="" method = "post">
                        <input type="text" placeholder = "produit" class="search_bar" name="recherche">
                        <input type="submit">
                    </form>
                    <a href="add_product.php"><button>+</button></a>
                </div>
                <?php
                    session_start();
                    if(isset($_SESSION["NEW_ADDITION"]) and $_SESSION["NEW_ADDITION"]){
                        echo("<p>produit ajouté</p>");
                        $_SESSION["NEW_ADDITION"] = FALSE;
                    }
                ?>
                <div class = "products_container">
                    <?php
                        for($i=0;$i<$tableLength;$i++){
                            ProductCard($table[$i][0],$table[$i][1]);
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>