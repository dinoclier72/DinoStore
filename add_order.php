<?php
    include("./components/database_server.php");

    $querry = 'SELECT id_client,client_name FROM client ORDER BY client_name';

    $result = $database -> query($querry);

    $table = [];

    for($i=0;$i<$result->num_rows;$i++){
        array_push($table,$result->fetch_row());
    }

    $tableLength = count($table);
?>
<?php
function article_display($article,$quantite,$prix){
    echo("<div class = 'article'>");
    echo("<p>".$article."</p>");
    echo("<p>".$quantite."</p>");
    echo("<p>".$prix."</p>");
    echo("</div>");
}
?>
<html>
    <head>
        <title>Ajouter une commande - DinoStore</title>
        <?php include './components/header.php' ?>
    </head>
    <body>
        <?php include './components/sidebar.php' ?>
        <div class = "content">
            <div class = "title">
                <?php include('./components/order_title.php')?>
            </div>
            <div class = "bar"></div>
            <div class = "all_the_content">
                <form action="sql_actions/addOrderToDataBase.php" method="post">
                    <div class = "companyStuff">
                        <label for="Companies">client: </label>
                        <select name="clients" id="clients">
                            <?php
                                $i = 0;
                                for($i=0;$i<$tableLength;$i++){
                                    echo("<option value=".$table[$i][0].">".$table[$i][1]."</option>");
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