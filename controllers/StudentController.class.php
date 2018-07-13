<?php

class StudentController {

	public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

	public function addAction($params) {		

		$v = new View("subscribe", "front");
		
	}

}