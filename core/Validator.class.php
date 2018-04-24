<?php
class Validator {
	public static function validateLogin($form, $params) {
		$errorMsg = [];

		foreach ($form['input'] as $name => $config) {
			
			if (isset($config['required']) && !self::minLength($params[$name], 1)) {
				$errorMsg[] = "Le champ ".$name." est manquant";
			}

		}

		$BSQL = new BaseSQL();
		$user = $BSQL->login($_POST['email'], $_POST['pwd']);
		if  ($user['count'] == 1) {
			if (password_verify($_POST['pwd'], $user['pwd'])) {

				$u = new User($user['id']);
				$u->setToken();
				$u->save();

				$_SESSION['token'] = $u->getToken();
				$_SESSION['user_id'] = $user['id'];

			} else {
				$errorMsg[] = "Mot de passe incorrect";
			}
		} else {
			$errorMsg[] = "L'e-mail n'existe pas";
		}

		return $errorMsg;
	}

    public static function validateAddUser($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();
        foreach ($form['input'] as $name => $config) {

            if (isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant.";
            }

            if ($config['type'] == "select" && ($params[$name] < 1 || $params[$name] > 3 )){
                $errorMsg[] = "Erreur sur " . $name . " : choisissez une option.";
            }

            if ($name == 'email' && !filter_var($params[$name], FILTER_VALIDATE_EMAIL)) {
                $errorMsg[] = "Entrez une adresse e-mail valide.";
            }

            if($name == 'email'){
                if($BSQL->emailAlreadyExists($params[$name])['count'] != 0){
                    $errorMsg[] = "Adresse e-mail déjà utilisée.";
                }
            }

        }

        return $errorMsg;
    }


    public static function validateAddClass($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();
        foreach ($form['input'] as $name => $config) {

            if (isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant.";
            }


        }

        return $errorMsg;
    }



	public static function minLength($value, $length) {
		return strlen(trim($value)) >= $length;
	}

}