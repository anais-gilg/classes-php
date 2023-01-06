<?php

session_start() ;

require('include/user.php') ;

// To prevent a user from accessing this page if they are not logged in
if (!isset($_SESSION['id'])){
    header('Location: ../index.php') ;
}

if(isset($_POST['envoyer'])){

    $id = $_SESSION['id'] ;
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
        <link rel="stylesheet" href="../css/style.css">
        <title>Profil</title>
    </head>

    <body>
        <div class="hder1">
            
            <?php require('include/header.php'); ?>          
            
        </div>

        <main>

            <div class="otherpage">
            
                <h1 class="modifh1">Modification</h1>

                <p class="msgerror"><?php //echo $msgError ?></p>
                <p class="msgsuccess"><?php //echo $msgSuccess ?></p>

                <div class="blocform">
                    <form action="" method="post" id="form">
                        
                        <div class="newinfo">
                        <input type="text" name="login" id="login" placeholder="New login" value="<?php echo $_SESSION['login'] ; ?>" required> <br />
                        <input type="text" name="email" id="email" placeholder="New email" value="<?php echo $_SESSION['email'] ; ?>" required> <br />
                        <input type="text" name="firstname" id="firstname" placeholder="New firstname" value="<?php echo $_SESSION['firstname'] ; ?>" required> <br />
                        <input type="text" name="lastname" id="lastnamme" placeholder="New lastname" value="<?php echo $_SESSION['lastname'] ; ?>" required> <br />

                        <!--type password to hide the code-->
                        <input type="password" name="password" id="password" placeholder="New password" required> <br/>
                        <br /> <br />
                        <input class="submit" type="submit" name="envoyer" value="Enter" id="buton">
                        </div>
                    </form>
                </div>

            </div>
        </main>

        <?php require("include/footer.php")?>

    </body>
</html>