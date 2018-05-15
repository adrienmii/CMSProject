<?php

class BaseSQL {
	private $pdo;
	private $table;
	private $columns;

	public function __construct() {
		try {
			$this->pdo = new PDO(DBDRIVER.":host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPWD);
		} catch (Exception $e) {
			//echo "Erreur SQL : ".$e->getMessage()."<br>Passez par l'installeur !";
		}
		$this->table = strtolower(get_called_class());
	}

	public function createDatabase($host,$user,$pwd,$port,$dbname) {
		// $dbname = strtoupper(htmlentities($dbname));
		try {
		    $PDO = new PDO("mysql:host=$host", $user, $pwd);
		    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
		    $PDO->exec($sql);

		    // on modifie le fichier de config
		    $configFile = fopen('conf.inc.php', 'w+');
		    $data = '<?php

	define("DBHOST", "'.$host.'");
	define("DBPORT", "'.$port.'");
	define("DBNAME", "'.$dbname.'");
	define("DBUSER", "'.$user.'");
	define("DBPWD", "'.$pwd.'");
	define("DBDRIVER", "mysql");
	define("DS", "/");
	$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
	define("DIRNAME", $scriptName.DS);';
		    fputs($configFile, $data);

		}
		catch(PDOException $e) {
		    return false;
		}
		return true;
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

    public function chapterInfoById($id)
    {
        $sql = "SELECT * FROM chapter WHERE id = '" . $id . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $c = $query->fetch();

        return $c;

    }

    public function getAllById($table, $id)
    {
        $sql = "SELECT * FROM ".$table." WHERE id = '" . $id . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $g = $query->fetch();

        return $g;
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

	public function removeTeacher($id_teach, $id_classe) {
		$query = $this->pdo->prepare("
			DELETE FROM classeteacher WHERE teacher = ".$id_teach." AND classe = ".$id_classe
		);

		$query->execute();
	}

	public function deleteClasseCascadeStudents($id) {
		$query = $this->pdo->prepare("
			UPDATE user SET classe = 0 WHERE classe = ".$id
		);

		$query->execute();
	}

	public function getChapters($option = null) {
		if (is_numeric($option)) {
			$sql = "SELECT p.id, label, description, c.classe, s.classname from chapter p INNER JOIN classeteacher c ON p.classe = c.classe INNER JOIN classe s ON c.classe = s.id where c.teacher = ".$option;
		 
		} elseif ($option == 'all') {
			$sql = "SELECT p.id, label, description, p.classe, c.classname from chapter p INNER JOIN classe c ON p.classe = c.id";
		}

		try { $query = $this->pdo->query($sql); }
		catch (Exception $e) { die('Erreur : '.$e->getMessage()); }
		$chapters = $query->fetchAll();

		return $chapters;
	}

}