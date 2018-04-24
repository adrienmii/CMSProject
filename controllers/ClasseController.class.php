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
                $classe = new Classe();
                $classe->setClassname($params['POST']['classname']);
                $classe->setTeacher($params['POST']['teacher']);
                $classe->save();

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

	public function getClassStundentAction($params) {		

		$v = new View("class", "front");
		
	}

	public function getTeacherClassesAction($params) {		

		$v = new View("myclasses", "front");
		
	}




}