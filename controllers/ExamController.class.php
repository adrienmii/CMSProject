<?php

class ExamController {
	
	public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

	public function participateAction($params) {		

		$v = new View("test", "front");
		
	}
	
}