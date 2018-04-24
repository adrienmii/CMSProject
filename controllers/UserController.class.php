<?php

class UserController {
	public function indexAction($params) {
		echo "Action par défaut d'un User";
	}
	public function addAction($params) {

        $user = new User();
        $form = $user->generateAddUserForm();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateAddUser($form, $params['POST']);

            if (empty($errors)) {
                $user = new User();
                $user->setFirstname($params['POST']['firstname']);
                $user->setLastname($params['POST']['name']);
                $user->setEmail($params['POST']['email']);
                $user->setRank($params['POST']['rank']);
                $user->setToken();
                $pwd = strtolower(substr($params['POST']['firstname'], 0, 1).substr($params['POST']['name'], 0, 4));
                $user->setPwd($pwd);
                $user->save();

                // envoi du mail au nouveau inscrit avec ses identifiants de connexion
                $mail = new Mail($user->getEmail(), "Vos identifiants de connexion", "Bonjour #PRENOM#,<br>Un compte vous a été crée sur EDULAB.<br><br>Voici vos identifiants :<br><br>E-mail : #EMAIL#<br>Mot de passe : #MOTDEPASSE# (Pensez à le modifier lors de votre première connexion !)<br><br>Cordialement,<br>EDULAB.", ["prenom" => $user->getFirstname(), "email" => $user->getEmail(), "motdepasse" => $pwd]);
                $mail->send();
            }

        }



		$v = new View("subscribe");
        $v->assign("config", $form);
        $v->assign("errors", $errors);

	}
	public function editAction($params) {
        $BSQL = new BaseSQL();
        if(!isset($params['URL'][0]) || empty($params['URL'][0]) || $BSQL->userExists($params['URL'][0])['count'] != 1){
                header('Location: ' . DIRNAME . 'user/add');
                exit();
        }

        $user = new User($params['URL'][0]);
        $form['form'] = $user->generateEditUserForm();
        $form['prefill'] = $BSQL->userInfoById($params['URL'][0]);

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateEditUser($form['form'], $params['POST']);

            if (empty($errors)) {
                $user->setFirstname($params['POST']['firstname']);
                $user->setLastname($params['POST']['lastname']);
                $user->setEmail($params['POST']['email']);
                $user->setRank($params['POST']['rank']);
                $user->setPwd((!empty($params['POST']['pwd']) ? $params['POST']['pwd'] : $form['prefill']['pwd']));
                $user->save();
            }

        }

        $v = new View("edit");
        $v->assign("config", $form);
        $v->assign("errors", $errors);
	}
	public function removeAction($params) {
		echo "Action de supression d'un User";
		echo var_dump($params);
	}

}