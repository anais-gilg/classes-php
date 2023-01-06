<?php

session_start() ;

require("include/user.php") ;



if(isset($_POST['envoyer'])){

    $login = $_POST['login'] ;
    $password = $_POST['password'] ;
    $email = $_POST['email'] ;
    $firstname = $_POST['firstname'] ;
    $lastname = $_POST['lastname'] ;

    $user = new User();
    $user->register($login, $password, $email, $firstname, $lastname) ;
}


?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css">
        <title>Inscription</title>
    </head>

    <body>
        
        
        <?php require("include/header.php"); ?>
        

        <main>

            <div class="otherpage">

                <h1 class="inscriph1">Inscription</h1>
                
                
                <form action="" method="post" id="from">
                    
                    <div class="newinfo">
                        <input type="text" name="login" id="login" placeholder="Login" autocomplete="off" required> <br>
                        <input type="text" name="email" id="email" placeholder="E-mail" autocomplete="off" required> <br>
                        <input type="text" name="firstname" id="firstname" placeholder="Firstname" autocomplete="off" required> <br>
                        <input type="text" name="lastname" id="lastname" placeholder="Lastname" autocomplete="off" required> <br>

                        <!--type password to hide the code-->
                        <input type="password" name="password" id="password" placeholder="Password" required> <br>
                        <br><br>
                        <input class="submit" type="submit" name="envoyer" value="Enter" id="buton">
                    </div>

                </form>
            </div>

        </main>

        <?php require("include/footer.php")?>

    </body>

</html>