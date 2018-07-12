<?php

class LoginController {
	
	public function indexAction($params) {
		$user = new User();
		$form = $user->generateLoginForm();

		$errors = null;

		

		if (!empty($params['POST'])) {
			// Vérification des saisies
			$errors = Validator::validateLogin($form, $params['POST']);

			if (empty($errors)) {
				header("Location: ".DIRNAME."dashboard");
				exit();
              
            } else {
            	$form['post'] = $params['POST'];
                new Notify($errors,"danger");
            }
		}

		$v = new View("login");
		$v->assign("config", $form);
		$v->assign("errors", $errors);

	}

}