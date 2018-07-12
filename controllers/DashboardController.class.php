<?php

class DashboardController {

    public function __construct() {
        if (empty($_SESSION['token'])) {
            header('Location: '.DIRNAME.'login');
            exit;
        }
    }

	public function indexAction($params) {		

		$BSQL = new BaseSQL();
		$userinfo = $BSQL->userInfoByToken();
		$user = new User($userinfo["id"]);

		
        $form = $user->generateNewPwdUserForm();
        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateEditUser($form, $params['POST']);

            $pwd = $params['POST']['pwd'];
            $pwd2 = $params['POST']['pwd2'];

            if($pwd != $pwd2){
                $errors = "Les mots de passe doivent être identiques";
            }

            if (empty($errors)) {
                $user->setPwdChanged(1);                
                $user->setPwd($params['POST']['pwd']);
                $user->save();

                $notify = new Notify("Votre mot de passe a été modifié avec succès","success");               
            }else{
                $notify = new Notify($errors,"danger");
            }

        }

		$v = new View("dashboard", "front");

		$v->assign("config", $form);
        $v->assign("errors", $errors);
	}
}