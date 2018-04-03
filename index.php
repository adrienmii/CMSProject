<?php
	session_start(); // session accessible partout sur le site
	require("conf.inc.php");


	function myAutoloader($class) {
		if (file_exists("core/".$class.".class.php")) {
			include("core/".$class.".class.php");
		} else if (file_exists("models/".$class.".class.php")) { // pour inclure automatiquement les modèles
			include("models/".$class.".class.php");
		} else {
			die($class."() : Error");
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
		die("Le fichier ".$c." n'existe pas");
	}
