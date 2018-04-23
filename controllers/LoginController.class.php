<?php

class LoginController {
	public function indexAction($params) {
		$user = new User();
		$form = $user->generateLoginForm();

		$errors = null;

		

		if (!empty($params['POST'])) {
			// Vérification des saisies
			$errors = Validator::validate($form, $params['POST']);

			if (empty($errors)) {
				header("Location : http://localhost/ProjetCMS/dashboard");
				exit();
			}
		}

		$v = new View("login");
		$v->assign("config", $form);
		$v->assign("errors", $errors);

	}

	public function logoutAction() {
		session_destroy();

		$user = new User();
		$form = $user->generateLoginForm();
		$errors = null;

		$v = new View("login");
		$v->assign("config", $form);
		$v->assign("errors", $errors);
	}

}