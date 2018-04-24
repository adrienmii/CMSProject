<?php

class ClasseController {

	public function indexAction($params) {		

		$v = new View("classes", "front");
		
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

                // marche pas !
            }

        }

		$v = new View("addClass");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
	}

	public function getClassStudentAction($params) {

		$v = new View("class", "front");
		
	}

	public function getTeacherClassesAction($params) {		

		$v = new View("myclasses", "front");
		
	}




}