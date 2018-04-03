<?php

class BaseSQL {
	private $pdo;
	private $table;
	private $columns;

	public function __construct() {
		try {
			$this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
		} catch (Exception $e) {
			die("Erreur SQL : ".$e->getMessage());
		}
		$this->table = strtolower(get_called_class());
	}

	public function setColumns() {
		$this->columns = array_diff_key(get_object_vars($this), get_class_vars(get_class())); //nécessite que les vars soient en protedted et pas private
	}

	public function save() {	
		$this->setColumns();

		// print_r(get_object_vars($this));

		if ($this->id) {
			//update

			unset($this->columns['id']);

			$this->columns = array_filter($this->columns);

			$set = null;
			foreach ($this->columns as $key => $value) {
				$set .= $key." = :".$key.", ";
			}

			$set = substr($set, 0, -2);

			$query = $this->pdo->prepare("
					UPDATE ".$this->table." SET	".$set." 
					WHERE id = ".$this->id
				);

			$query->execute($this->columns);

		} else {
			//insert

			unset($this->columns['id']);

			$query = $this->pdo->prepare("
					INSERT INTO ".$this->table." 
					(".implode(",",array_keys($this->columns)).") 
					VALUES 
					(:".implode(",:",array_keys($this->columns)).")
				");

			$query->execute($this->columns);
		}

	}

	public function login($email, $pwd) {	
		$sql = "SELECT id, COUNT(*) as count, pwd FROM user WHERE email = '".$email."'";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$user = $query->fetch();

		return $user;
	}
}