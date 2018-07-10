<?php

class BaseSQL
{
    private $pdo;
    private $table;
    private $columns;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPWD);
        } catch (Exception $e) {
            //echo "Erreur SQL : ".$e->getMessage()."<br>Passez par l'installeur !";
        }
        $this->table = strtolower(get_called_class());
    }

    public function createDatabase($host, $user, $pwd, $port, $dbname)
    {
        $dbname = strtoupper(htmlentities($dbname));
        try {
            $PDO = new PDO("mysql:host=$host", $user, $pwd);
            $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;
            $PDO->exec($sql);

            // on modifie le fichier de config
            $configFile = fopen('conf.inc.php', 'w+');
            $data = '<?php
			define("DBHOST", "' . $host . '");
			define("DBPORT", "' . $port . '");
			define("DBNAME", "' . $dbname . '");
			define("DBUSER", "' . $user . '");
			define("DBPWD", "' . $pwd . '");
			define("DBDRIVER", "mysql");
			define("DS", "/");
			define("DBBONFIGURED", true);
			$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
			define("DIRNAME", $scriptName.DS);';
            fputs($configFile, $data);

        } catch (PDOException $e) {
            return false;
        }

        try {
            $db = new PDO(DBDRIVER . ":host=" . $host . ";dbname=" . $dbname, $user, $pwd);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Error Handling

            $source = $db->query(file_get_contents('base.sql'));

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

        return true;
    }


    public function setColumns()
    {
        $this->columns = array_diff_key(get_object_vars($this), get_class_vars(get_class())); //nécessite que les vars soient en protedted et pas private
    }

    public function save()
    {
        $this->setColumns();

        // print_r(get_object_vars($this));

        if ($this->id) {
            //update

            unset($this->columns['id']);

            $this->columns = array_filter($this->columns, 'strlen');


            $set = null;
            foreach ($this->columns as $key => $value) {
                $set .= $key . " = :" . $key . ", ";
            }

            $set = substr($set, 0, -2);

            $query = $this->pdo->prepare("
					UPDATE " . $this->table . " SET	" . $set . " 
					WHERE id = " . $this->id
            );

            $query->execute($this->columns);

        } else {
            //insert

            unset($this->columns['id']);

            $query = $this->pdo->prepare("
					INSERT INTO " . $this->table . " 
					(" . implode(",", array_keys($this->columns)) . ") 
					VALUES 
					(:" . implode(",:", array_keys($this->columns)) . ")
				");

            $query->execute($this->columns);

            return $this->pdo->lastInsertId();
        }

    }

    public function delete()
    {
        $query = $this->pdo->prepare("
			DELETE FROM " . $this->table . " WHERE id = " . $this->id
        );

        $query->execute();
    }

    public function login($email, $pwd)
    {
        $sql = "SELECT id, COUNT(*) as count, pwd FROM user WHERE email = '" . $email . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $user = $query->fetch();

        return $user;
    }

    public function emailAlreadyExists($email)
    {
        $sql = "SELECT COUNT(*) as count FROM user WHERE email = '" . $email . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $user = $query->fetch();

        return $user;
    }

    public function userExists($id)
    {
        $sql = "SELECT COUNT(*) as count FROM user WHERE id = '" . $id . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $user = $query->fetch();

        return $user;
    }

    public function userInfoByToken()
    {
        $sql = "SELECT * FROM user WHERE token = '" . $_SESSION['token'] . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
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

    public function alreadyAdminExists()
    {
        $sql = "SELECT count(*) AS nb FROM user WHERE rank = 1";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $r = $query->fetch();

        return $r['nb'];
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
        $sql = "SELECT * FROM " . $table . " WHERE id = '" . $id . "'";
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

    public function getTeachersAndAdmin()
    {
        $sql = "SELECT id, firstname, lastname FROM user WHERE rank = 2 OR rank = 1 AND status = 1";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $t = $query->fetchAll();

        return $t;
    }

    public function studentsWithoutClasse()
    {
        $sql = "SELECT id, firstname, lastname FROM user WHERE rank = 3 AND status = 1 AND classe IS NULL OR classe = 0";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $s = $query->fetchAll();

        return $s;
    }

    public function getAllClasses()
    {
        $sql = "SELECT * FROM classe";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $classes = $query->fetchAll();

        return $classes;
    }

    public function getStudentByClasseId($id)
    {
        $sql = "SELECT * FROM user WHERE classe = " . $id . " AND rank = 3 AND status = 1";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $classe = $query->fetchAll();

        return $classe;
    }

    public function getCountClasse($idClass)
    {
        $sql = "SELECT count(*) as count FROM user WHERE classe = " . $idClass . " AND status = 1";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $count = $query->fetch();

        return $count['count'];
    }

    public function getCountUsers()
    {
        $sql = "SELECT count(*) as count FROM user WHERE status = 1";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $count = $query->fetch();

        return $count['count'];
    }

    public function getCountCourse($id)
    {
        $sql = "SELECT count(*) as count FROM course WHERE teacher = " . $id;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $count = $query->fetch();

        return $count['count'];
    }

    public function getCountTeachers($id)
    {
        $sql = "SELECT count(*) as count FROM classeteacher c INNER JOIN user u ON u.id = c.teacher WHERE status = 1 AND c.classe = " . $id;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $count = $query->fetch();

        return $count['count'];
    }

    public function getClasseTeacher($id)
    {
        $sql = "SELECT * FROM classeteacher c INNER JOIN user u ON u.id = c.teacher WHERE status = 1 AND c.classe = " . $id;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $t = $query->fetchAll();

        return $t;
    }

    public function teachersExceptClasseId($id)
    {
        $sql = "SELECT * FROM user WHERE id NOT IN (SELECT c.teacher FROM user u INNER JOIN classeteacher c ON u.id = c.teacher WHERE c.classe = '" . $id . "' AND (rank = 1 OR rank = 2)) AND (rank = 1 OR rank = 2)";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $t = $query->fetchAll();

        return $t;
    }

    public function deleteClasseCascadeTeachers($id)
    {
        $query = $this->pdo->prepare("
			DELETE FROM classeteacher WHERE classe = " . $id
        );

        $query->execute();
    }

    public function removeTeacher($id_teach, $id_classe)
    {
        $query = $this->pdo->prepare("
			DELETE FROM classeteacher WHERE teacher = " . $id_teach . " AND classe = " . $id_classe
        );

        $query->execute();
    }

    public function deleteClasseCascadeStudents($id)
    {
        $query = $this->pdo->prepare("
			UPDATE user SET classe = 0 WHERE classe = " . $id
        );

        $query->execute();
    }

    public function getChapters($option = null)
    {
        if (is_numeric($option)) {
            $sql = "SELECT p.id, label, description, c.classe, s.classname from chapter p INNER JOIN classeteacher c ON p.classe = c.classe INNER JOIN classe s ON c.classe = s.id INNER JOIN user u ON c.classe = u.classe where u.id = " . $option;

        } elseif ($option == 'all') {
            $sql = "SELECT p.id, label, description, p.classe, c.classname from chapter p INNER JOIN classe c ON p.classe = c.id";
        }

        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $chapters = $query->fetchAll();

        return $chapters;
    }

    public function getCoursesByTeacher($id)
    {
        $sql = "SELECT course.id as course, chapter.id as chapter, course.*, chapter.* from course INNER JOIN chapter ON course.chapter = chapter.id WHERE course.teacher = " . $id;

        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $courses = $query->fetchAll();

        return $courses;
    }

    public function getCoursesByChapter($id)
    {
        $sql = "SELECT c.id as course, c.*, p.* from course c INNER JOIN chapter p ON c.chapter = p.id WHERE p.id = " . $id;

        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $courses = $query->fetchAll();

        return $courses;
    }

    public function courseInfoById($id)
    {
        $sql = "SELECT course.id as course, chapter.id as chapter, course.*, chapter.* FROM course INNER JOIN chapter ON course.chapter = chapter.id WHERE course.id = '" . $id . "'";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $c = $query->fetch();

        return $c;

    }

    public function getQCMById($id)
    {
        $sql = "SELECT * FROM QCM WHERE id = $id";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $qcm = $query->fetch();

        return $qcm;
    }

    public function getQCMByTeacherId($teacherId)
    {
        $sql = "SELECT QCM.*, classe.classname AS classname FROM QCM INNER JOIN classe ON classe.id = QCM.classe WHERE teacher=" . $teacherId;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $qcms = $query->fetchAll();

        return $qcms;
    }

    public function getQuestionsByQCM($qcmId)
    {
        $sql = "SELECT * FROM questionQCM WHERE idQCM=" . $qcmId;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $questions = $query->fetchAll();

        return $questions;
    }

    public function getQuestionById($questionId)
    {
        $sql = "SELECT * FROM questionQCM WHERE id=" . $questionId;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $questions = $query->fetch();

        return $questions;
    }

    public function countQuestionsByQCM($qcmId)
    {
        $sql = "SELECT COUNT(id) AS nbQuestions FROM questionQCM WHERE idQCM=" . $qcmId;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $nbQuestions = $query->fetch();

        return $nbQuestions;
    }

    public function getQCMByClassId($classId)
    {
        $sql = "SELECT * FROM QCM WHERE classe=" . $classId;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $nbQuestions = $query->fetchAll();

        return $nbQuestions;
    }

    public function isQCMDone($idUser, $idQCM){
        $sql = "SELECT COUNT(id) AS isDone FROM participateQCM WHERE idUser=". $idUser ." AND idQCM=". $idQCM;
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $done = $query->fetch();

        return $done;
    }


    public function getScheduleSettings()
    {
        $sql = "SELECT * FROM scheduleSettings";
        try {
            $query = $this->pdo->query($sql);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $settings = $query->fetch();

        return $settings;
    }

}