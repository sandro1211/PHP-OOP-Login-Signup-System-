<?php 

include_once('Session.php');
include_once('Database.php');
class User{
	private $db;
	private $_supportedformat=['image/png','image/jpg','image/jpeg'];
	public function __construct()
	{
		$this->db = new Database();
	}
	public function userRegistration($data)
	{
		$name     = $data['name'];
		$username = $data['username'];
		$password = md5($data['password']);
		$email    = $data['email'];
		$photo    = $data['file'];
		$chk_mail = $this->emailCheck($email);

		if ($name=='' OR $username=='' OR $password=='' OR $email=='') {
			$msg = "<div class='alert alert-danger'><strong>ERROR !</strong>Field Must Not Be Empty</div>";
			return $msg;
		}
		if (strlen($username)<3) {
			$msg = "<div class='alert alert-danger'><strong>ERROR !</strong>username is too Short!</div>";
			return $msg;
		}elseif (preg_match('/[^a-z0-9_-]+/i', $username)) {
			$msg = "<div class='alert alert-danger'><strong>ERROR !</strong>Username must only contain alphanumerical, dashes and unserscore!</div>";
			return $msg;
		}
		if (filter_var($email,FILTER_VALIDATE_EMAIL)===false) {
			$msg = "<div class='alert alert-danger'><strong>ERROR !</strong>Email Address is not valid!</div>";
			return $msg;
		}

		if ($chk_mail==true) {
			$msg = "<div class='alert alert-danger'><strong>ERROR !</strong>Email Address already Exist!</div>";
			return $msg;
		}
          

        if(is_array($photo)){  
		if(in_array($photo,$this->_supportedformat)){
       move_uploaded_file($photo['tmp_name'],'uploads/'.$photo['tmp_name']);

		}
		else{

			die('File format is not supported');
		}
	}
		else{

			die('File was not uploaded');
		}



		$sql = "INSERT INTO tbl_user (name, username, email, password, img) VALUES (:name, :username, :email, :password, :photo)";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':name',$name);
		$query->bindValue(':username',$username);
		$query->bindValue(':email',$email);
		$query->bindValue(':password',$password);
		$query->bindValue(':img',$photo);
		$result = $query->execute();
		if ($result) {
			$msg = "<div class='alert alert-success'>Registered</div>";
			return $msg;
		}
		else
		{
			$msg = "<div class='alert alert-danger'>Error</div>";
			return $msg;
		}
		
	}

	public function emailCheck($email)
	{
		$sql = "SELECT email FROM tbl_user WHERE email = :email";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->execute();
		if ($query->rowCount() > 0) {
			return true;
		}
		else{
			return false;
		}

	}

	public function userLogin($data)
	{
		
		$password = md5($data['password']);
		$email    = $data['email'];
		$chk_mail = $this->emailCheck($email);

		if ($password=='' OR $email=='') {
			$msg = "<div class='alert alert-danger'>Field Must Not Be Empty</div>";
			return $msg;
		}
		if (filter_var($email,FILTER_VALIDATE_EMAIL)===false) {
			$msg = "<div class='alert alert-danger'>Email Address is not valid</div>";
			return $msg;
		}
		$result = $this->getloginUser($email,$password);
		if ($result) {
			Session::init();
			Session::set("login",true);
			Session::set("id",$result->id);
			Session::set("name",$result->name);
			Session::set("username",$result->username);
			Session::set("loginmsg","<div class='alert alert-success'>You are Loggedin.</div>");
			header("Location:index.php");
		}else{
			$msg = "<div class='alert alert-danger'>Data not Found!</div>";
			return $msg;
		}
	}

	public function getloginUser($email,$password)
	{
		$sql = "SELECT * FROM tbl_user WHERE email = :email AND password = :password LIMIT 1";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':email',$email);
		$query->bindValue(':password',$password);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function getuserdata()
	{
		$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}
	public function getUserById($id)
	{
		$sql = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':id',$id);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result;
	}

	public function updateUser($id, $data)
	{
		$name = $data['name'];
		$username = $data['username'];
		$email = $data['email'];

		if ($name=='' OR $username==''OR $email=='') {
			$msg = "<div class='alert alert-danger'>Field Must Not Be Empty</div>";
			return $msg;
		}

		

		$sql = "UPDATE tbl_user SET name = :name, username = :username, email = :email WHERE id = :id ";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':name',$name);
		$query->bindValue(':username',$username);
		$query->bindValue(':email',$email);
		$query->bindValue(':id',$id);
		$result = $query->execute();
		if ($result) {
			$msg = "<div class='alert alert-success'>Updated</div>";
			return $msg;
		}
		else
		{
			$msg = "<div class='alert alert-danger'>Try Again</div>";
			return $msg;
		}
	}

}



?>