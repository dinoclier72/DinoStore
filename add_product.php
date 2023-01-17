<?php
    include("./components/database_server.php");

    $querry = 'SELECT name FROM company ORDER BY name';

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
                oui
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
                        <button>+</button>
                    </div>
                    <button>AJOUTER</button>
                </form>
            </div>
        </div>
    </body>
</html>