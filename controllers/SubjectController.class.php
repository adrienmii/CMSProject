<?php

class SubjectController {

	public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

	public function listCoursesAction($params) {		

		$v = new View("myCourses", "front");
		
	}
	
}