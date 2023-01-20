<?php
    include("./components/database_server.php");

    $querry = 'SELECT company_name FROM company ORDER BY company_name';

    $result = $database -> query($querry);

    $table = [];

    for($i=0;$i<$result->num_rows;$i++){
        array_push($table,$result->fetch_row()[0]);
    }

    $tableLength = count($table);
?>

<html>
    <head>
        <title>Ajouts de produits - DinoStore</title>
        <?php include './components/header.php' ?>
    </head>
    <body>
        <?php include './components/sidebar.php' ?>
        <div class = "content">
            <div class = "title">
            <?php include('./components/product_title.php')?>
            </div>
            <div class = "bar"></div>
            <div class = "all_the_content">
                <form action="sql_actions/addProductToDataBase.php" method="post">
                    <p>Nom du Produit: <input type="text" name = "nom"></p>
                    <div class = "companyStuff">
                        <label for="Companies">Entrepeise: </label>
                        <select name="Companies" id="Companies">
                            <?php
                                $i = 0;
                                for($i=0;$i<$tableLength;$i++){
                                    echo("<option value=".$table[$i].">".$table[$i]."</option>");
                                }
                            ?>
                        </select>
                        <a href="add_company.php"><button type="button">+</button></a>
                    </div>
                    <button>AJOUTER</button>
                </form>
            </div>
        </div>
    </body>
</html>