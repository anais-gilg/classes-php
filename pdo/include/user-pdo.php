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
    public function __construct() 
    {
		try {

			// DB connection 
			$server = "localhost" ;
			$dbname = "classes" ;
			$user = "root" ;
			$pswd = "root" ;

			$this->connect = new PDO("mysql:host=$server;dbname=$dbname;charset=UTF8", $user, $pswd) ;
			$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ; // Set the PDO error mode to Exception
			echo 'Connection established' ;
			
		} 
		catch (PDOException $e) { // $e for Exception // Exceptions are caught if an exception is thrown
			echo "Error !: " . $e->getMessage() . "<br/>" ; // We display *information about it*
		}

		// To close the connection
		// $connect = NULL

	}

	//------------------------------------------------------ REGISTER
	
	public function register($login, $password, $email, $firstname, $lastname)
	{
		
		$this->login = $login ;
        $this->password = $password ;
        $this->email = $email ;
        $this->firstname = $firstname ;
        $this->lastname = $lastname ;

		$req = "INSERT INTO `utilisateurs`(`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login','$password','$email','$firstname','$lastname')" ;
		$this->connect->prepare($req) ;
		$this->connect->exec($req) ;
		header('location: connection.php') ;
	
	}

	//------------------------------------------------------ CONNECT

	public function connect($login, $password)
	{

		$req = $this->connect->query("SELECT * FROM `utilisateurs` WHERE login='$login'") ;
		$verify = $req->rowCount() ;

		if($req->rowCount() == 1){
			$data = $req->fetch(PDO::FETCH_ASSOC) ;
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

	//------------------------------------------------------ ISCONNECTED
		
	public function isConnected() 
	{
        if(isset($_SESSION['login'])) {
            return true;
        }
    }

	//------------------------------------------------------ UPDATE

	public function update($login, $password, $email, $firstname, $lastname)
	{

		$id = $_SESSION['id'] ;
		
		if($_SESSION['login'] != $login){
			$req = $this->connect->prepare ("UPDATE `utilisateurs` SET login = ? WHERE id = ?") ; 			
			$update = $req->execute(array($login, $id)) ; 
			$_SESSION['login'] = $login ;
		}			
		
		if($_SESSION['password'] != $password){
			$req = $this->connect->prepare ("UPDATE `utilisateurs` SET password = ? WHERE id = ?") ;
			$upadate=$req->execute(array($password, $id)) ; 
			$_SESSION['email'] = $email ;
		}
		
		if($_SESSION['email'] != $email){
			$req = $this->connect->prepare ("UPDATE `utilisateurs` SET email = ? WHERE id = ?") ;
			$upadate=$req->execute(array($email, $id)) ; 
			$_SESSION['email'] = $email ;
		}
			
		if($_SESSION['firstname'] != $firstname ){
			$req = $this->connect->prepare ("UPDATE `utilisateurs` SET firstname = ? WHERE id = ?") ;
			$upadate=$req->execute(array($firstname, $id)) ; 
			$_SESSION['email'] = $email ;
		}

		if($_SESSION['lastname'] != $lastname ){
			$req = $this->connect->prepare ("UPDATE `utilisateurs` SET lastname = ? WHERE id = ?") ;
			$upadate=$req->execute(array($lastname, $id)) ; 
			$_SESSION['email'] = $email ;
		}
		
		header("location: profil.php") ;
		
	}

	//------------------------------------------------------ DISCONNECT

	public function disConnect() // Logout
    {
        session_unset() ;
        session_destroy() ;  
        header('Location: ../index.php') ;
    }

	//------------------------------------------------------ DELETE

	public function delete()
	{
		$id = $_SESSION['id'] ;
		$req = $this->connect->query("DELETE FROM `utilisateurs` WHERE id='$id'") ;
		$this->disConnect() ;
		header('Location: ../index.php') ;

	}

	//------------------------------------------------------ GETALLINFO

	public function getAllInfos()
	{
		echo <<<HTML
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Login</th>
								<th>E-mail</th>
								<th>Prénom</th>
								<th>Nom</th>
							</tr>
						</thead>
					
						<tbody>
							<tr>
								<td>{$_SESSION['id']}</td>
								<td>{$_SESSION['login']}</td>
								<td>{$_SESSION['email']}</td>
								<td>{$_SESSION['firstname']}</td>
								<td>{$_SESSION['lastname']}</td>
							</tr>
						</tbody>
					</table>
				HTML ;
	}

}

	//------------------------------------------------------ GETLOGIN

	function getLogin()
	{
		echo $_SESSION['login'] ;
	}

	//------------------------------------------------------ GETALLEMAIL
 
	function getEmail()
	{
		try {
		echo $_SESSION['email'] ;
		}
		catch(PDOException $e) { // $e for Exception // Exceptions are caught if an exception is thrown
			echo "Error !: " . $e->getMessage() . "<br/>" ; // We display *information about it*
		}
	}

	//------------------------------------------------------ GETFIRSTNAME

	function getFirstname()
	{
		echo $_SESSION['firstname'] ;
	}

	//------------------------------------------------------ GETLASTNAME

	function getLastname()
	{
		echo $_SESSION['lastname'] ;
	}



	/*	
	function getDatabaseConnexion() {
	}

	
	// récupere tous les users
	function getAllUsers() {
		$con = getDatabaseConnexion();
		$requete = 'SELECT * from utilisateurs';
		$rows = $connect->query($requete);
		return $rows;
	}


	//recupere un user
	function readUser($id) {
		$con = getDatabaseConnexion();
		$requete = "SELECT * from utilisateurs where id = '$id' ";
		$stmt = $connect->query($requete);
		$row = $stmt->fetchAll();
		if (!empty($row)) {
			return $row[0];
		}
		
	}

	//met à jour le user
	function updateUser($id, $nom, $prenom, $age, $adresse) {
		try {
			$con = getDatabaseConnexion();
			$requete = "UPDATE utilisateurs set 
						nom = '$nom',
						prenom = '$prenom',
						age = '$age',
						adresse = '$adresse' 
						where id = '$id' ";
			$stmt = $connect->query($requete);
		}
	    catch(PDOException $e) {
	    	echo $stmt . "<br>" . $e->getMessage();
	    }
	}

	// suprime un user
	function deleteUser($id) {
		try {
			$con = getDatabaseConnexion();
			$requete = "DELETE from utilisateurs where id = '$id' ";
			$stmt = $connect->query($requete);
		}
	    catch(PDOException $e) {
	    	#echo $sql . "<br>" . $e->getMessage();
	    }
	} 
	*/
	 
?>
