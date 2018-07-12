<?php

class InstallController {

	public function indexAction($params) {		

		// si déjà configuré
		if (DBBONFIGURED) {
			header('Location: '.DIRNAME.'login');
			exit;
		}	

		$v = new View("installer");
		$v->assign("step", 'general');
		
	}

	public function dbAction($params) {	
		// si déjà configuré
		if (DBBONFIGURED) {
			header('Location: '.DIRNAME.'install/admin');
			exit;
		}	

		$install = new Install();
        $form = $install->generateForm();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateInstall($form, $params['POST']);

            if (empty($errors)) {
            	$BSQL = new BaseSQL();

            	if ($BSQL->createDatabase($params['POST']['host'],$params['POST']['user'],$params['POST']['pwd'],$params['POST']['port'], $params['POST']['dbname'])) {

            		$notify = new Notify("La db a été crée","success");
            		header('Location: '.DIRNAME.'install/admin');
            		exit;

            	} else {
            		$notify = new Notify("Impossible de créer la base, vérifiez votre saisie","danger");
            	}      
            }else{
                $notify = new Notify($errors,"danger");
            }
        }

		$v = new View("installer");
		$v->assign("step", 'db');
		$v->assign("config", $form);
        $v->assign("errors", $errors);
		
	}

	public function adminAction($params) {	
		$BSQL = new BaseSQL();

		if ($BSQL->alreadyAdminExists() >= 1) {
			header('Location: '.DIRNAME.'login');
		}

		$admin = new User();
        $form = $admin->generateInstallForm();

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateEditUser($form, $params['POST']);

            if (empty($errors)) {
            	$admin->setFirstname($params['POST']['firstname']);
                $admin->setLastname($params['POST']['lastname']);
                $admin->setEmail($params['POST']['email']);
                $admin->setRank(1); // car sera notre 1er admin
                $admin->setStatus(1);
                $admin->setToken();
                $admin->setPwd($params['POST']['pwd']);
                $admin->setPwdChanged(1);
                $admin->save();

            	$notify = new Notify("L'admin a été crée","success");
            	header('Location: '.DIRNAME.'login');
            	exit;
            	     
            }else{
                $notify = new Notify($errors,"danger");
            }
        }

		$v = new View("installer");
		$v->assign("step", 'admin');
		$v->assign("config", $form);
        $v->assign("errors", $errors);	
		
	}
	
}