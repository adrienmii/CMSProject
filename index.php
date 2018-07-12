<?php
	session_start(); // session accessible partout sur le site
	//ini_set("display_errors", 0);
	require("conf.inc.php");


	function myAutoloader($class) {
		if ($class != "LoginController") {
			if (file_exists("core/".$class.".class.php")) {
				include("core/".$class.".class.php");
			} else if (file_exists("models/".$class.".class.php")) { // pour inclure automatiquement les modèles
				include("models/".$class.".class.php");
			} else {
				die($class."() : Error index.php");
			}
		}
	}

	spl_autoload_register("myAutoloader"); // dans le cas ou on instancie une classe qui n'existe pas => autoloader car pas sur qu'on va utiliser cette classe donc il gère pour nous l'inclusion


	// RECUPERER L'URL SANS LE DOSSIER PRINCIPAL
	$uri = str_ireplace(DIRNAME, "", urldecode($_SERVER['REQUEST_URI'])); // decode = remplace les %20 en espace
	
	$uri = substr(urldecode($_SERVER['REQUEST_URI']), strlen(dirname($_SERVER['SCRIPT_NAME']))); // Nouvelle Méthode de faire !!
	$uri = ltrim($uri, "/");

	$uri = explode("?", $uri); // pour échapper les param de l'URL

	$uriExplode = explode("/", $uri[0]);

	$c = (empty($uriExplode[0]))?"index":$uriExplode[0];
	$a = (empty($uriExplode[1]))?"index":$uriExplode[1];

	$c = ucfirst(strtolower($c))."Controller";
	$a = strtolower($a)."Action";

	unset($uriExplode[0]); // on supprime la valeur du controlleur
	unset($uriExplode[1]); // la valeur de l'action

	// LES PARAMETRES 
	$params = [
				"POST" => $_POST,
				"GET" => $_GET,
				"FILES" => $_FILES,
				"URL" => array_values($uriExplode), //recommence un tableau avec des clés de 0 à partir d'un autre tableau
			  ];

	// VERIFIER QUE LE FICHIER EXISTE
	if (file_exists("controllers/".$c.".class.php")) {
		include("controllers/".$c.".class.php");
		// VERIFIER QUE LA CLASSE EXISTE
		if (class_exists($c)) {
			$objC = new $c(); // instanciation d'un objet de façon dynamique
			// VERIFIER QUE LA MATHODE EXISTE
			if (method_exists($objC, $a)) {
				$objC->$a($params); // appel d'une méthode de l'objet précédemment crée

			} else {
				die("L'action ".$a." n'existe pas dans ".$c); 
			}
		} else {
			die("Le controller ".$c." n'existe pas");
		}
	} else {
		header('Location: '.DIRNAME.'error');
        exit;
		//die("Le fichier ".$c." n'existe pas");
	}


	// VERIFIER SI USER PEUT ACCEDER A LA ROUTE

    $routeAccessAdmin = [
        "",
    ];
	$BSQL = new BaseSQL(); 
	if(isset($_SESSION['token'])){
		$userinfo = $BSQL->userInfoByToken($_SESSION['token']);
		if($userinfo['rank'] == 1){

		}
	}



	if (isset($_SESSION['token']) && isset($_SESSION['user_id'])) {
		$BSQL = new BaseSQL();
		$userinfo = $BSQL->userInfoByToken($_SESSION['token']);
		if ($userinfo['id'] == $_SESSION['user_id']) { 
			$u = new User($userinfo['id']);
			$u->setToken();
			$u->save();

			$_SESSION['token'] = $u->getToken();
			
			echo "<div style='top:0px;right:0px;z-index:10;position:fixed;background-color:#cd5c5ce0;color:white;padding:10px;'>Connecté (<a href='".DIRNAME."logout' style='color:white'>".$userinfo['firstname']." ".$userinfo['lastname']."</a>) w/ token : ".$_SESSION['token']."</div>";
		} else {
			// si token user de la session est différent de la base on déco
			echo "<div style='top:0px;right:0px;z-index:10;position:fixed;background-color:#cd5c5ce0;color:white;padding:10px;'>Déconnecté automatiquement par sécurité</div>";
			session_destroy();
		}
	}
