<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Header</title>
    </head>

    <body>
        <div class="containerheader">
            <?php if (isset($_SESSION['login'])) {?> <!-- If login connected, display this -->
            
            <div class="hder2">            
                <header>
                    <nav>
                        <ul>
                            <li><a href="http://localhost:8888/classes-php/pdo/index.php">Home</a></li>
                            <li><a href="http://localhost:8888/classes-php/pdo/profil.php">Modification</a></li>
                            <li><a href="http://localhost:8888/classes-php/pdo/infos.php">My account</a></li> 
                            <li><a href="http://localhost:8888/classes-php/pdo/include/logout.php">Logout</a></li>
                        </ul>
                    </nav>
                <header>
            </div>
            
            <?php } else { ?>
                
                <div class="hder2">
                    
                    <header>
                        <nav>
                            <ul>
    
                                <li><a href="http://localhost:8888/classes-php/pdo/index.php">Home</a></li>
                                <li><a href="http://localhost:8888/classes-php/pdo/connection.php">Log in</a></li> 
                                <li><a href="http://localhost:8888/classes-php/pdo/inscription.php">Create an account</a></li>
                            </ul>
                        </nav>
                    </header>
                    </div>
                
            <?php } ?>
        </div>

    </body>
                
</html>