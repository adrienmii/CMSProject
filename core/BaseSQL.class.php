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

	public function delete() {
		$query = $this->pdo->prepare("
			DELETE FROM ".$this->table." WHERE id = ".$this->id
		);

		$query->execute();
	}

	public function login($email, $pwd) {	
		$sql = "SELECT id, COUNT(*) as count, pwd FROM user WHERE email = '".$email."'";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$user = $query->fetch();

		return $user;
	}

    public function emailAlreadyExists($email) {
        $sql = "SELECT COUNT(*) as count FROM user WHERE email = '".$email."'";
        try { $query = $this->pdo->query($sql); }
        catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
        $user = $query->fetch();

        return $user;
    }

    public function userExists($id) {
        $sql = "SELECT COUNT(*) as count FROM user WHERE id = '".$id."'";
        try { $query = $this->pdo->query($sql); }
        catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
        $user = $query->fetch();

        return $user;
    }

	public function userInfoByToken() {
		$sql = "SELECT * FROM user WHERE token = '".$_SESSION['token']."'";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$user = $query->fetch();

		return $user;
	}

	public function userInfoById($id)
    {
        $sql = "SELECT * FROM user WHERE id = '" . $id . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $user = $query->fetch();

        return $user;

    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM user WHERE status=1";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $user = $query->fetchAll();

        return $user;

    }

	public function teacherWithoutClasse() {
		$sql = "SELECT id, firstname, lastname FROM user WHERE rank = 2 AND id NOT IN (SELECT teacher FROM classe)";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$users = $query->fetchAll();

		return $users;
	}

	public function getAllClasses() {
		$sql = "SELECT * FROM class";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$classes = $query->fetchAll();

		return $classes; 
	}

}