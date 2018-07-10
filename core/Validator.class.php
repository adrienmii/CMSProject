<?php
class Validator {
	public static function validateLogin($form, $params) {
		$errorMsg = [];

		foreach ($form['input'] as $name => $config) {
			
			if (isset($config['required']) && !self::minLength($params[$name], 1)) {
				$errorMsg[] = "Le champ ".$name." est manquant";
			}

            if ($name == 'captcha') {
                if (strtolower($_SESSION['captcha']) != strtolower($_POST['captcha'])) {
                    $errorMsg[] = "Le ".$name." saisi est incorrect";
                }
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
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "select" && ($params[$name] < 1 || $params[$name] > 3 )){
                $errorMsg[] = "Erreur sur " . $name . " : choisissez une option";
            }

            if ($name == 'email' && !filter_var($params[$name], FILTER_VALIDATE_EMAIL)) {
                $errorMsg[] = "Entrez une adresse e-mail valide";
            }

            if($name == 'email'){
                if($BSQL->emailAlreadyExists($params[$name])['count'] != 0){
                    $errorMsg[] = "Adresse e-mail déjà utilisée";
                }
            }

        }

        return $errorMsg;
    }

    public static function validateSettings($form, $params, $files = null)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();
        foreach ($form['input'] as $name => $config) {

            if (isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "file" && $files[$name]["name"] != null){
                $target_dir = "./public/img/";
                $target_file = $target_dir . basename($files[$name]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                
                if ($files[$name]["size"] > 500000) {
                    $errorMsg[] = "Votre image doit faire moins de 500 Ko";
                    $uploadOk = 0;
                }

                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $errorMsg[] = "Votre image doit être au format JPG, JPEG, PNG ou GIF";
                    $uploadOk = 0;
                }

                if ($uploadOk == 1) {
                    move_uploaded_file($files[$name]["tmp_name"], $target_file);
                }
            }
        }

        return $errorMsg;
    }

    public static function validateEditUser($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();
        foreach ($form['input'] as $name => $config) {

            if (isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "select" && ($params[$name] < 1 || $params[$name] > 3 )){
                $errorMsg[] = "Erreur sur " . $name . " : choisissez une option";
            }

            if ($name == 'email' && !filter_var($params[$name], FILTER_VALIDATE_EMAIL)) {
                $errorMsg[] = "Entrez une adresse e-mail valide";
            }

            if($name == 'pwd' && isset($params[$name]) && !empty($params[$name]) && !self::checkPwd($params[$name])){
                $errorMsg[] = "Votre mot de passe doit contenir des majuscules, des minuscules, des chiffres et doit faire plus de 5 caractères";
            }

        }

        return $errorMsg;
    }


    public static function validateAddClass($form, $params)
    {   
        $errorMsg = [];
        $BSQL = new BaseSQL();
        foreach ($form['input'] as $name => $config) {

            if ($config['type'] == "text" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "text" && isset($config['required']) && !self::maxLength($params[$name], 8)) {
                $errorMsg[] = "Le champ " . $name . " est trop long (8 caractères maximum)";
            }

            if ($config['type'] == "select" && !array_key_exists(trim($name,"[]"),$params)){
                $errorMsg[] = "Vous devez choisir des éléments dans " . trim($name,"[]");
            }


        }

        return $errorMsg;
    }

    public static function validateChapter($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();
        foreach ($form['input'] as $name => $config) {

            if ($config['type'] == "text" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "text" && isset($config['required']) && !self::maxLength($params[$name], 120)) {
                $errorMsg[] = "Le champ " . $name . " est trop long (120 caractères maximum)";
            }

            if ($config['type'] == "select" && !array_key_exists(trim($name,"[]"),$params)){
                $errorMsg[] = "Vous devez choisir des éléments dans " . trim($name,"[]");
            }

        }

        return $errorMsg;
    }


    public static function validateInstall($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();

        foreach ($form['input'] as $name => $config) {

            if ($config['type'] == "text" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "text" && isset($config['required']) && !self::maxLength($params[$name], 140)) {
                $errorMsg[] = "Le champ " . $name . " est trop long";
            }

        }

        return $errorMsg;

    }

    public static function validateCourse($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();

        if(empty($params['content'])){
            $errorMsg[] = "Le contenu du cours est manquant";
        }
        foreach ($form['input'] as $name => $config) {

            if ($config['type'] == "text" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "select" && !array_key_exists(trim($name,"[]"),$params)){
                $errorMsg[] = "Vous devez choisir des éléments dans " . trim($name,"[]");
            }

        }

        return $errorMsg;
    }


    public static function validateQCM($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();

        if(empty($params['label'])){
            $errorMsg[] = "Veuillez indiquer le titre du QCM";
        }

        foreach ($form['input'] as $name => $config) {

            if ($config['type'] == "text" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }
        }

        return $errorMsg;
    }

    public static function validateQuestionQCM($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();

        if(empty($params['question'])){
            $errorMsg[] = "Veuillez indiquer une question";
        }

        if(empty($params['answer1']) || empty($params['answer2'])){
            $errorMsg[] = "Veuillez remplir au moins 2 réponses";
        }
        foreach ($form['input'] as $name => $config) {

            if ($config['type'] == "text" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "select" && !array_key_exists(trim($name,"[]"),$params)){
                $errorMsg[] = "Vous devez choisir des éléments dans " . trim($name,"[]");
            }

        }

        return $errorMsg;
    }

    public static function validateScheduleSettings($form, $params)
    {
        $errorMsg = [];
        $BSQL = new BaseSQL();


        //ici on vérifie si on peut remplir la journée sans qu'il y est de trou
        $firstHour = $params['firstHour'];
        $lastHour = $params['lastHour'];
        $lunchTime = $params['lunchTime'];
        $lunchHour = $params['lunchHour'];
        $courseTime = $params['courseTime'];

        
        $firstHourExploded = explode(':', $firstHour);
        $lastHourExploded = explode(':', $lastHour);
        $lunchTimeExploded = explode(':', $lunchTime);

        //conversion en minute des variables
        $minutesLunchTime = ($lunchTimeExploded[0] * 60.0 + $lunchTimeExploded[1] * 1.0);
        $courseTimeExploded = explode(':', $courseTime);
        $minutesCourseTime = ($courseTimeExploded[0] * 60.0 + $courseTimeExploded[1] * 1.0);

        // Calcul du nombres de minutes dans une journée ex:8h45 à 17h30 = 9x60
        $minutesDay = 0;
        for($i = intval($firstHourExploded[0]); $i < intval($lastHourExploded[0]); $i++){
            $minutesDay += 60;
        }

        // on ajoute les minutes de la derniere heure de cours ex:+30 min de 17h30
        $minutesDay += $lastHourExploded[1];
        // on retire les minutes de la premiere heure de cours ex:-45 min de 8h45
        $minutesDay -= $firstHourExploded[1];
         // on retire les minutes de la pause lunch
        $minutesDay -= $minutesLunchTime;
        // on divise le nombre total de cours en minutes par la durée d'un cours en minutes 
        $nbCoursesPerDay = $minutesDay/$minutesCourseTime;

        //Si c'est un float c'est qu'il y aura des trous dans la planning. On doit récupérer un resultat rond 
        if (strpos($nbCoursesPerDay,'.')) {
            $errorMsg[] = "Votre planning aura des périodes vides avec la configuration des heures actuelles";
        }

        foreach ($form['input'] as $name => $config) {

            if ($config['type'] == "number" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

            if ($config['type'] == "number" && isset($config['required']) && !self::maxLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est trop long";
            }

            if ($config['type'] == "text" && isset($config['required']) && !self::minLength($params[$name], 1)) {
                $errorMsg[] = "Le champ " . $name . " est manquant";
            }

             if ($config['type'] == "text" && isset($config['required']) && !self::maxLength($params[$name], 140)) {
                $errorMsg[] = "Le champ " . $name . " est trop long";
            }

        }

        return $errorMsg;
    }


    public static function checkPwd($pwd){
        return strlen($pwd)>5 && preg_match("/[A-Z]/", $pwd) && preg_match("/[a-z]/", $pwd) && preg_match("/[0-9]/", $pwd);
    }

	public static function minLength($value, $length) {
		return strlen(trim($value)) >= $length;
	}

    public static function maxLength($value, $length) {
        return strlen(trim($value)) <= $length;
    }

}