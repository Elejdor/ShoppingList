<html>
    <header>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
        
        <link rel="stylesheet" href="css/style.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

        <script src="js/jquery-1.11.1.min.js"/></script>
</header>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Shopping list</a>
        </div>
    </div>
    <div class="container theme-">
        
        <div class="jumbotron centerText" role="main">
            <?php
            include 'mysql_connection.php';
            include 'php/ShoppingList.php';
            include 'config.php';

            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                if ($action == 'submit')
                    include 'views/submit.php';
                if ($action == 'add')
                    include 'views/create_list.php';
            }
            else {
                include 'views/get_name.php';
            }
            //include 'views/get_shopping_list.php';
            ?>
        </div>

    </div>


</body>
</html>


