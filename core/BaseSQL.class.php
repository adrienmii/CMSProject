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

			$this->columns = array_filter($this->columns, 'strlen');


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

			return $this->pdo->lastInsertId();
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

    public function classeInfoById($id)
    {
        $sql = "SELECT * FROM classe WHERE id = '" . $id . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $classe = $query->fetch();

        return $classe;

    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM user WHERE status = 1";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $user = $query->fetchAll();

        return $user;

    }

	public function getTeachersAndAdmin() {
		$sql = "SELECT id, firstname, lastname FROM user WHERE rank = 2 OR rank = 1 AND status = 1";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$t = $query->fetchAll();

		return $t;
	}

	public function studentsWithoutClasse() {
		$sql = "SELECT id, firstname, lastname FROM user WHERE rank = 3 AND status = 1 AND classe IS NULL OR classe = 0";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$s = $query->fetchAll();

		return $s;
	}

	public function getAllClasses() {
		$sql = "SELECT * FROM classe";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$classes = $query->fetchAll();

		return $classes; 
	}

	public function getStudentByClasseId($id) {
		$sql = "SELECT * FROM user WHERE classe = ".$id." AND rank = 3 AND status = 1";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$classe = $query->fetchAll();

		return $classe; 
	}

	public function getCountClasse($idClass) {
		$sql = "SELECT count(*) as count FROM user WHERE classe = ".$idClass." AND status = 1";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$count = $query->fetch();

		return $count['count']; 
	}

	public function getCountUsers() {
		$sql = "SELECT count(*) as count FROM user WHERE status = 1";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$count = $query->fetch();

		return $count['count']; 
	}

	public function getCountTeachers($id) {
		$sql = "SELECT count(*) as count FROM classeteacher c INNER JOIN user u ON u.id = c.teacher WHERE status = 1 AND c.classe = ".$id;
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$count = $query->fetch();

		return $count['count']; 
	}

	public function getClasseTeacher($id) {
		$sql = "SELECT * FROM classeteacher c INNER JOIN user u ON u.id = c.teacher WHERE status = 1 AND c.classe = ".$id;
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$t = $query->fetchAll();

		return $t; 
	}

	public function teachersExceptClasseId($id) {
		$sql = "SELECT * FROM user WHERE id NOT IN (SELECT c.teacher FROM user u INNER JOIN classeteacher c ON u.id = c.teacher WHERE c.classe = '".$id."' AND (rank = 1 OR rank = 2)) AND (rank = 1 OR rank = 2)";
		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$t = $query->fetchAll();

		return $t; 
	}

	public function deleteClasseCascadeTeachers($id) {
		$query = $this->pdo->prepare("
			DELETE FROM classeteacher WHERE classe = ".$id
		);

		$query->execute();
	}

	public function deleteClasseCascadeStudents($id) {
		$query = $this->pdo->prepare("
			UPDATE user SET classe = 0 WHERE classe = ".$id
		);

		$query->execute();
	}

}