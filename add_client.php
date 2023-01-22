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
                <form action="sql_actions/addClientToDataBase.php" method="post">
                    <p>nom du client: <input type="text" name = "nom"></p>
                    <button>AJOUTER</button>
                </form>
            </div>
        </div>
    </body>
</html>