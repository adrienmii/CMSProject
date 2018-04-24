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
                $pwd = strtoupper(substr($params['POST']['name'], 0, 4).substr($params['POST']['firstname'], 0, 1));
                $user->setPwd($pwd);
                $user->save();
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
        var_dump($user);
        $form = $user->generateEditUserForm();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateAddUser($form, $params['POST']);

            if (empty($errors)) {
                $user->setFirstname($params['POST']['firstname']);
                $user->setLastname($params['POST']['name']);
                $user->setEmail($params['POST']['email']);
                $user->setRank($params['POST']['rank']);
                $user->setPwd($params['POST']['pwd']);
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