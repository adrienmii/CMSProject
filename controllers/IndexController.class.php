<?php

class IndexController {

	public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

	public function indexAction($params) {
		// si n'est pas connecté rediriger vers page login sinon vers le dashboard
		if (empty($_SESSION['token'])) {
			header('Location: '.DIRNAME.'login');
			exit;
		} else {
			header('Location: '.DIRNAME.'dashboard');
			exit;
		}
	}
}