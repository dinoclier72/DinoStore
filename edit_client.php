<?php
session_start();
if(isset($_POST["clientID"])){
    $_SESSION["clientID"] = $_POST["clientID"];
    $_POST = array();
}
include("components/database_server.php");
$result = $database -> query("SELECT client_name,rank_name FROM client NATURAL JOIN membership_rank WHERE id_client =".$_SESSION["clientID"]);
$table = $result->fetch_row();
$result = $database->query("SELECT type,social_name,id_socials FROM socials WHERE id_client =".$_SESSION["clientID"]);
$sTable = [];
for($i=0;$i<$result->num_rows;$i++){
    array_push($sTable,$result->fetch_row());
}
array_push($table,$sTable);
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
                <form action="" method="post">
                    <p>nom du client: <input type="text" name = "nom" value = <?php echo("'".$table[0]."'")?>></p>
                    <button>EDIT</button>
                </form>
                <p>rang: <?php echo($table[1])?><button type = button> UPGRADE</button></p>
                <p>SOCIALS:<br>
                        <?php
                        for($i=0;$i<count($table[2]);$i++){
                            echo("<form action='sql_actions/editDatabaseSocial.php' method = 'post'>");
                            echo("<input name = 'social_type' value = '".$table[2][$i][0]."'>");
                            echo("<input name = 'social_name' value = ".$table[2][$i][1].">");
                            echo("<input name = 'id_social'type = 'hidden' value = ".$table[2][$i][2].">");
                            echo("<button type = 'submit'>EDIT</button>");
                            echo("</form>");
                        }
                        ?>
                        <a href="sql_actions/addSocialToClient.php"><button>ADD SOCIALS</button></a>
                    </p>
                    <p>POINTS: </p>
                    <button>ADD POINTS</button><br>
                    
            </div>
        </div>
    </body>
</html>