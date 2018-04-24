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
        $classe = new Classe($params['URL'][0]);
        $classe->delete();

        header('Location: '.DIRNAME.'classe');
        exit();
	}

    public function listAction($params) {

    	$BaseSQL = new BaseSQL();
    	$students = $BaseSQL->getStudentByClasseId($params['URL'][0]);
    	$count = $BaseSQL->getCountClasse($params['URL'][0]);
    	$classe = $BaseSQL->classeInfoById($params['URL'][0]);
    	$teachers = $BaseSQL->getClasseTeacher($params['URL'][0]);

		$v = new View("class", "front");
		$v->assign("students", $students);
		$v->assign("count", $count);
		$v->assign("classe", $classe);
		$v->assign("teachers", $teachers);
		
	}

	public function getTeacherClassesAction($params) {		

		$v = new View("myclasses", "front");
		
	}




}