<?php

class User {
    // Objects property
    private $connect ;
    private $id ;
    public $login ;
    private $password ;
    public $email ;
    public $firstname ;
    public $lastname ;

    // Object constructor
    # https://www.pierre-giraud.com/php-mysql-apprendre-coder-cours/oriente-objet-constructeur-destructeur/  PG for complete information
    function __construct() 
    {
        $server = 'localhost';
        $user = 'root';
        $password = 'root';
        $dbname = 'classes';
    
        // Create a connection
        $this->connect = mysqli_connect($server, $user, $password, $dbname);
    }

    // Objects methods aka functions
    function register($login, $password, $email, $firstname, $lastname)
    {  
        $this->login = $login ;
        $this->password = $password ;
        $this->email = $email ;
        $this->firstname = $firstname ;
        $this->lastname = $lastname ;

        $req = "SELECT `login` FROM `utilisateurs` WHERE login = '$login'" ; // Select login to check if it already exists in db
        $request = mysqli_query($this->connect, $req) ; // We execute the request w/ db connection

            if(mysqli_num_rows($request) > 0){ // Check if the information entered already exists 
                echo "This login already exists" ;
            }
            else {
                $result = $this->connect->query("INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login','$password', '$email', '$firstname', '$lastname')") ;
                header('location: connection.php') ;
            }
            
    }

    function connect($login, $password)
    {
        $req = "SELECT * FROM `utilisateurs` WHERE login='$login'" ;
        $request = mysqli_query($this->connect, $req) ;

        if(mysqli_num_rows($request) == 1){
            $data = mysqli_fetch_assoc($request) ;
            $_SESSION['id'] = $data['id'] ;
            $_SESSION['login'] = $data['login'] ;
            $_SESSION['password'] = $data['password'] ;
            $_SESSION['email'] = $data['email'] ;
            $_SESSION['firstname'] = $data['firstname'] ;
            $_SESSION['lastname'] = $data['lastname'] ;

            header('location: index.php') ;
        }
        else {
            $msgError = "ID incorrect, <br> please check your login and/or password" ;
        }
    }

    public function isConnected() {
        if(isset($_SESSION['login'])) {
            return true;
        }
    }
    
    public function update($id, $login, $password, $email, $firstname, $lastname)
    {
        $id = $_SESSION['id'] ;
        $this->id = $id ;
        $this->login = $login ;
        $this->password = $password ;
        $this->email = $email ;
        $this->firstname = $firstname ;
        $this->lastname = $lastname ;

        // Recover the information of the connected user
        $recupUser = mysqli_query($this->connect, "SELECT * FROM `utilisateurs` WHERE id = '$id'" ) ;
            // the function mysqli_fetch_array() returns an array that matches the retrieved row.
        $user = mysqli_fetch_array($recupUser) ;

        $check_login = mysqli_query($this->connect, "SELECT * FROM `utilisateurs` WHERE login='$login'") ;

        $req = "UPDATE `utilisateurs` SET `login`='$login',`password`='$password',`email`='$email',`firstname`='$firstname',`lastname`='$lastname' WHERE login=$login" ;
        $request = mysqli_query($this->connect, $req) ;

        #----------------check if data are present in the db----------------#
        $check_login = mysqli_query($this->connect, "SELECT * FROM `utilisateurs` WHERE login='$login'");
        // the function mysqli_num_rows() check if data are present in the db
        // https://www.geeksforgeeks.org/php-mysqli_num_rows-function/

        if(mysqli_num_rows($check_login) === $_SESSION['id']){
            $request ;
        }
        elseif (mysqli_num_rows($check_login) !== $_SESSION['id']){
            $request ;
        }




        // Si le login est identique au login de la session en cours 
        if (mysqli_num_rows($check_login) === $id){
            $samelogin = $request ;
            $msgSucces = 'The modification has been correctly done' ;
        }
        elseif (mysqli_num_rows($check_login) !== $id){
            $samelogin = $request ;
            $msgSuccess = 'The modification has been correctly done' ;
        }
        else {
            $msgError ='This login already exists' ;
        }

        
    }

    function disConnect() // Logout
    {
        session_unset() ;
        session_destroy() ;  
        header('Location: ../index.php') ;
    }

    public function delete($id)
    {
        $this->connect;     
        $req = "DELETE FROM `utilisateurs` WHERE id = '$id'";
        $request = mysqli_query($this->connect, $req);
        $this->disConnect(); 
    }




    // Getters methods
    # read the value of a non-existent property of the class
    public function getAllInfos()
    {
        
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }


}

$user = new User();

?>