<?php 
namespace php_class;

class User {
	use traits\ConnectionSetting;
	use traits\UserSetting;
	protected $error = "";

	public function getErrorMessage(){
		return $this->error;
	}

	protected function find_user_by_email($email, $fetch = false){
		$columns = ($fetch) ? "*" : $this->user_id_col_name;
		$query = "SELECT $columns FROM $this->user_table_name WHERE $this->user_email_col_name = :email LIMIT 1";
		try{
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':email', $email);
			$stmt->execute();
			$user = $stmt->fetch(\PDO::FETCH_ASSOC);
			if(!$user){
				$this->error = "کاربر پیدا نشد";
				return false;
			}elseif($fetch){
				$this->error = "";
				return $user;
			}else{
				$this->error = "";
				return TRUE;
			}
		}catch(\PDOException $ex){
			die($ex->getMessage() . " | Code Line: " . __LINE__);
		}	
	}

	protected function find_user_by_id($id, $fetch = false){
		$columns = ($fetch) ? "*" : $this->user_id_col_name;
		$query = "SELECT $columns FROM $this->user_table_name WHERE $this->user_id_col_name = :id LIMIT 1";
		try{
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':id', $id);
			$stmt->execute();
			$user = $stmt->fetch(\PDO::FETCH_ASSOC);
			if(!$user){
				$this->error = "کاربر پیدا نشد";
				return false;
			}elseif($fetch){
				$this->error = "";
				return $user;
			}else{
				$this->error = "";
				return TRUE;
			}
		}catch(\PDOException $ex){
			die($ex->getMessage() . " | Code Line: " . __LINE__);
		}	
	}

	public function assign_email($firstname, $lastname, $email){
		$firstname = htmlentities($firstname);
		$lastname = htmlentities($lastname);
		$email = htmlentities($email);

		if($this->find_user_by_email($email, FALSE)){
			$this->error = "این ایمیل قبلا ثبت شده است.";
			return FALSE;
		}

		$query = "INSERT INTO $this->user_table_name ($this->user_email_col_name, $this->user_firstname_col_name, $this->user_lastname_col_name) VALUES (:email, :firstname, :lastname)";
		try{
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":firstname", $firstname);
			$stmt->bindParam(":lastname", $lastname);
			$success = $stmt->execute();
			if(!$success){
				$this->error = "متاسفانه خطایی رخ داده است";
				return false;
			}

			$this->error = $this->conn->lastInsertId();
			return TRUE;

		}catch(\PDOException $ex){
			die($ex->getMessage() . " | Code Line: " . __LINE__);
		}
	}

	public function get_all_assignments(){
		$columns = $this->user_id_col_name . ", " . $this->user_email_col_name . ", " . $this->user_firstname_col_name . ", " . $this->user_lastname_col_name; 
		$query = "SELECT  $columns FROM $this->user_table_name WHERE 1 ORDER BY $this->user_id_col_name";
		try{
			$stmt = $this->conn->query($query);
			$assignments = array();
			while($row = $stmt->fetch()){
				$assignments[] = $row;
			}
			return $assignments;
		}catch(\PDOException $ex){
			die($ex->getMessage() . " | Code Line: " . __LINE__);
		}
	}

	public function delete_assignment(int $id){
		if(!$this->find_user_by_id($id, FALSE)){
			$this->error = "ایمیل مورد نظر پیدا نشد.";
			return FALSE;
		}

		$query = "DELETE FROM $this->user_table_name WHERE $this->user_id_col_name = :id";
		try{
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':id', $id);
			if(!$stmt->execute()){
				$this->error = "متاسفانه خطایی رخ داده است.";
				return FALSE;
			}
			$this->error = "";
			return TRUE;

		}catch(\PDOException $ex){
			die($ex->getMessage() . " | Code Line: " . __LINE__);
		}
	}

	public function edit_assignment(int $id, $firstname, $lastname, $email){
		$firstname = htmlentities($firstname);
		$lastname = htmlentities($lastname);
		$email = htmlentities($email);

		if(!$this->find_user_by_id($id, FALSE)){
			$this->error = "این ایمیل پیدا نشد.";
			return FALSE;
		}

		$query = "UPDATE $this->user_table_name SET $this->user_email_col_name = :email, $this->user_firstname_col_name = :firstname, $this->user_lastname_col_name = :lastname WHERE $this->user_id_col_name = :id LIMIT 1";
		try{
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(":email", $email);
			$stmt->bindParam(":firstname", $firstname);
			$stmt->bindParam(":lastname", $lastname);
			$stmt->bindParam(":id", $id);
			if(!$stmt->execute()){
				$this->error = "متاسفانه خطایی رخ داده است";
				return false;
			}

			$this->error = $id;
			return TRUE;

		}catch(\PDOException $ex){
			die($ex->getMessage() . " | Code Line: " . __LINE__);
		}
	}
	
}
