<?php

session_start() ;

require('include/user.php') ;

if(isset($_POST['envoyer'])){

    $login = htmlspecialchars($_POST['login']) ;
    $password = htmlspecialchars($_POST['password']) ;
    $email = htmlspecialchars($_POST['email']) ;
    $firstname = htmlspecialchars($_POST['firstname']) ;
    $lastname = htmlspecialchars($_POST['lastname']) ;

    $user = new User();
    $user->update($id, $login, $password, $email, $firstname, $lastname) ;
}

?>

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Admin</title>
    </head>

    <body>

        <div class="hder1">
            <header>
                <?php require("include/header.php"); ?>
            </header>
        </div>

        <main>

            <div class="array">

                <table>
                    <tbody>                     
                        <tr>                    
                            <th>Id</th>       
                            <th>Login</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                        </tr>  

                        <?php 
                        
                        foreach($showdb as $resultat => $personne){
                            echo 
                            "<tr>                    
                                <td>$personne[0]</td>       
                                <td>$personne[1]</td>
                                <td>$personne[2]</td>
                                <td>$personne[3]</td>
                            </tr>";
                        }
                        ?>

                        
                    </tbody>
                </table>

            </div>

        </main>
        
    </body>
</html>