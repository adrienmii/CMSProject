<?php

class LoginController {
	public function indexAction($params) {
		if (!empty($_POST['submit_signin']) && isset($_POST['submit_signin'])) {
			if ($_POST['submit_signin']) {
				$BSQL = new BaseSQL();
				$user = $BSQL->login($_POST['email'], $_POST['pwd']);
				if  ($user['count'] == 1) {
					if (password_verify($_POST['pwd'], $user['pwd'])) {
						echo 'OK user existe';
		
						$u = new User($user['id']);
						$u->setToken();
						$u->save();

						$_SESSION['token'] = $u->getToken();


					} else {
						echo "mdp correspondent pas";
					}
				}
			}
		}
		$v = new View("login");
	}

	public function logoutAction() {

		$BSQL = new BaseSQL();
		$user = $BSQL->user();
		$user->setToken(1);
		$user->save();

		session_destroy();
	}

}