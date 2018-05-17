<?php

class SettingsController {


	public function indexAction($params) {		
		

		$settings = new Settings(1);
        $form = $settings->generateForm();

        $BSQL = new BaseSQL();
        $form['prefill'] = $BSQL->getAllById('settings', 1);

        $errors = null;

        if (!empty($params['POST'])) {
            // Vérification des saisies
            $errors = Validator::validateSettings($form, $params['POST'], $params['FILES']);

            if (empty($errors)) {
            	$settings->setSitename($params['POST']['sitename']);
            	$settings->setAddress($params['POST']['address']);

            	// si l'utilisateur a uplaod une image lors de la validation du form
            	if (!empty($params['FILES']['logo']["name"])) {
					$settings->setLogo($params['FILES']['logo']["name"]);
				}

				$settings->save();


            	$notify = new Notify("Les paramètres généraux ont bien été modifiés", "success");

            	header('Location: '.DIRNAME.'settings');
                exit();
            } else {
            	$form['post'] = $params['POST'];
                $notify = new Notify($errors, "danger");
            }
        }

		$v = new View("settings", "front");
	    $v->assign("config", $form);
        $v->assign("errors", $errors);
		
	}

}