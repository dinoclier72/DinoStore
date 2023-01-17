<?php
include("components/database_server.php");
$result = $database->query("SELECT product.name,company.name FROM product JOIN company ON product.id_company=company.id_company ORDER BY company.name");
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
                oui
            </div>
            <div class = "bar"></div>
            <div class = "all_the_content">
                <div class = "product_header">
                    <form action="" method = "post">
                        <input type="text" placeholder = "produit" class="search_bar" name="recherche">
                        <input type="submit">
                    </form>
                    <a href="add_product.php"><button>+</button></a>
                </div>
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