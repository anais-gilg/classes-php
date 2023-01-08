<?php

session_start() ;
require("include/user-pdo.php") ;

$user = new User() ;
$user->getAllInfos() ;
$user->getLogin() ;
$user->getEmail() ;
$user->getFirstname() ;
$user->getLastname() ;

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Admin</title>
    </head>

    <body>

        <div class="hder1">

            <?php require("include/header.php"); ?>

        </div>

        <main>


        </main>

        <?php require("include/footer.php"); ?>
        
    </body>
</html>