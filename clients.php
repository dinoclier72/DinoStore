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
function clientCard($ClientName,$ClientSocials){
    echo("<div class = 'clientCard'>");
    echo("<p>".$ClientName."</p>");
    for($i=0;$i<count($ClientSocials);$i++){
        echo("<p>".$ClientSocials[$i]."</p>");
    }
    echo("</div>");
}
?>

<html>
    <head>
        <title>Le DinoStore</title>
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
                <div class = "general_commands">
                    <form action="" method = "post">
                        <input type="text" placeholder = "clients" class="search_bar" name="recherche">
                        <input type="submit">
                    </form>
                    <a href="add_client.php"><button>+</button></a>
                </div>
                <div class = "clients_container">
                </div>
            </div>
        </div>
    </body>
</html>