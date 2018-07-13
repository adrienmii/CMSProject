<?php

class TimetableController {

	public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

	public function indexAction($params) {		

		$v = new View("edt", "front");
		
	}

}