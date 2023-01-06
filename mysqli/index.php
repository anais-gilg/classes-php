<?php

session_start() ;

require("include/user.php") ;

$user = new User() ;

// var_dump($_SESSION) ;

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Home</title>
    </head>

    <body>
        
        <?php require("include/header.php"); ?>
        

        <main class="mainindex">
            <div class="welcome">
                <?php if ($user->isConnected()) {?>
                    
                    <h1>Welcome aboard the OOP, <?php echo $_SESSION['login'] ?> ! </h1>
                    
                <?php } else {?>
                    <h1>Travel in class ! </h1>
                <?php } ?>
            </div>
            
        </main>

        <?php require("include/footer.php")?>
        
    </body>

</html>