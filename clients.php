<?php
include("components/database_server.php");
$result = $database->query("SELECT client_name,rank_name,id_client FROM client NATURAL JOIN membership_rank ORDER BY client_name");
$table = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($table,$result->fetch_row());
    $subTable = [];
    $subResult = $database->query("SELECT type,social_name FROM socials WHERE id_client = ".$table[$i][2]);
    for($j=0;$j<$subResult->num_rows;$j++){
        array_push($subTable,$subResult->fetch_row());
    }
    array_push($table[$i],$subTable);
}
$tableLength = count($table);
?>

<?php
function clientCard($ClientName,$ClientRank,$ClientSocials){
    echo("<div class = 'clientCard'>");
    echo("<p>".$ClientName."</p>");
    echo("<p>".$ClientRank."</p>");
    echo("<p>Socials</p>");
    echo("<div class = 'clientCardSocials'>");
    for($i=0;$i<count($ClientSocials);$i++){
        echo("<p>".$ClientSocials[$i][0].":".$ClientSocials[$i][1]."</p>");
    }
    echo("</div>");
    echo("<button>EDIT</button>");
    echo("</div>");
}
?>

<html>
    <head>
        <title>Le DinoStore</title>
        <?php include './components/header.php' ?>
        <link rel="stylesheet" href="css/clients.css">
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
                    <?php
                        for($i=0;$i<$tableLength;$i++){
                            $currentCLient = $table[$i];
                            clientCard($currentCLient[0],$currentCLient[1],$currentCLient[3]);
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>