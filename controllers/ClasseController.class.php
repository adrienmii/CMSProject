<?php

class ClasseController {

	public function indexAction($params) {	

		$BaseSQL = new BaseSQL();
		$classes = $BaseSQL->getAllClasses();


		$v = new View("classes", "front");
		$v->assign("classes", $classes);
		
	}

	public function addAction($params) {
		$class = new Classe();
        $form = $class->generateForm();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateAddClass($form, $params['POST']);

            if (empty($errors)) {

                // echo var_dump($params);
                // die();

                $classe = new Classe();
                $classe->setClassname($params['POST']['classname']);
                $lastInsertId = $classe->save();

                // on associe autant de fois la classe avec les profs
                foreach ($params['POST']['teachers'] as $teacher) {
                    $classeteacher = new ClasseTeacher();
                    $classeteacher->setClasse($lastInsertId);
                    $classeteacher->setTeacher($teacher);
                    $classeteacher->save();
                }

                header('Location: '.DIRNAME.'classe');
                exit();
            }

        }

		$v = new View("addClass");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
	}

	public function deleteAction($params) {
        $BaseSQL = new BaseSQL();
        $BaseSQL->deleteClasseCascadeStudents($params['URL'][0]);
        $BaseSQL->deleteClasseCascadeTeachers($params['URL'][0]);

        $classe = new Classe($params['URL'][0]);
        $classe->delete();

        header('Location: '.DIRNAME.'classe');
        exit();
	}

    public function removeStudentAction($params) {
        $user = new User($params['URL'][0]);
        $user->setClasse(0);
        $user->save();

        header('Location: '.DIRNAME.'classe');
        exit();
    }

    public function removeTeacherAction($params) {
        $classeteacher = new ClasseTeacher($params['URL'][0]);
        $classeteacher->delete();

        header('Location: '.DIRNAME.'classe');
        exit();
    }

    public function editAction($params) {
        $class = new Classe();
        $form = $class->generateFormEdit();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateAddClass($form, $params['POST']);

            if (empty($errors)) {

                // echo var_dump($params);
                // die();

                $classe = new Classe($params['URL'][0]);
                $classe->setClassname($params['POST']['classname']);
                $classe->save();

              
                header('Location: '.DIRNAME.'classe');
                exit();
            }

        }

        $v = new View("editClass");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
    }

    public function listAction($params) {

    	$BaseSQL = new BaseSQL();
    	$students = $BaseSQL->getStudentByClasseId($params['URL'][0]);
    	$count = $BaseSQL->getCountClasse($params['URL'][0]);
    	$classe = $BaseSQL->classeInfoById($params['URL'][0]);
    	$teachers = $BaseSQL->getClasseTeacher($params['URL'][0]);
        $countTeachers = $BaseSQL->getCountTeachers($params['URL'][0]);

		$v = new View("class", "front");
		$v->assign("students", $students);
		$v->assign("count", $count);
		$v->assign("classe", $classe);
		$v->assign("teachers", $teachers);
        $v->assign("countTeachers", $countTeachers);
		
	}

    public function addStudAction($params) {  

        $class = new Classe();
        $form = $class->generateFormStudents();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateAddClass($form, $params['POST']);

            if (empty($errors)) {

                // echo var_dump($params);
                // die();

                foreach ($params['POST']['students'] as $student) {
                    $user = new User($student);
                    $user->setClasse($params['URL'][0]);
                    $user->save();
                }

                header('Location: '.DIRNAME.'classe/list/'.$params['URL'][0]);
                exit();
            }

        }


        $v = new View("addStudents", "front");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
        
    }

        public function addTeachAction($params) {  

        $class = new Classe();
        $form = $class->generateFormTeachers($params['URL'][0]);

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateAddClass($form, $params['POST']);

            if (empty($errors)) {

                // echo var_dump($params);
                // die();

                foreach ($params['POST']['teachers'] as $teacher) {
                    $classeteacher = new ClasseTeacher();
                    $classeteacher->setClasse($params['URL'][0]);
                    $classeteacher->setTeacher($teacher);
                    $classeteacher->save();
                }

                header('Location: '.DIRNAME.'classe/list/'.$params['URL'][0]);
                exit();
            }

        }


        $v = new View("addTeachers", "front");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
        
    }

	public function getTeacherClassesAction($params) {		

		$v = new View("myclasses", "front");
		
	}




}