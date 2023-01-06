<?php

session_start() ;

if(isset($_POST['envoyer'])){

    $login = $_POST['login'] ;
    $password = $_POST['password'] ;

    require ("include/user.php") ;
    $user->connect($login, $password) ;
}

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Connection</title>
    </head>

    <body>
          
        <?php require("include/header.php"); ?>
        
        <main>
            <div class="otherpage">
                <h1 class="connecth1">Log in</h1>

                <form action="" method="post" id="from" class="bref" >
                    <div class="newinfo">
                        <input type="text" name="login" id="login" placeholder="Login" required> <br>
                        <input type="password" name="password" id="password" placeholder="Password" required> <br>
                        <input class="submit" type="submit" name="envoyer" value="Enter" id="buton">
                    </div>
                </form>
            </div>
        </main>

        <?php require("include/footer.php")?>

    </body>

</html>