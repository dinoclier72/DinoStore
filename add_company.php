<html>
    <head>
        <title>Ajouts d'entreprise - DinoStore</title>
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
                <form action="sql_actions/addCompanyToDataBase.php" method="post">
                    <p>Nouvelle entreprise: <input type="text" name = "nom"></p>
                    <button>AJOUTER</button>
                </form>
            </div>
        </div>
    </body>
</html>