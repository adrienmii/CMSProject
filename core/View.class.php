<?php

class View {

	private $v;
	private $t;
	private $data = [];

	public function __construct($v = "default", $t = "front") {
		$this->v = $v.".view.php";
		$this->t = $t.".tpl.php";

		if (!file_exists("views/templates/".$this->t)) {
			die("Le template ".$this->t." n'existe pas.");
		}

		// if (!file_exists("views/".$this->v)) {
		// 	die("La vue ".$this->v." n'existe pas.");
		// }
	}

	public function __destruct() {
		global $c, $a; // va chercher une variable globale déclarée plus tôt
		extract($this->data); // transforme les clés du tableau en variables
		if ($this->v != "login.view.php" && $this->v != "installer.view.php" && $this->v != "error.view.php") {
			include("views/templates/".$this->t); // dans le destruct pour pouvoir passer des paramètres avant l'affichage
		} else {
			if (file_exists("views/admin/".$this->v)) {
				include("views/admin/".$this->v);
			}elseif (file_exists("views/teacher/".$this->v)) {
				include("views/teacher/".$this->v);
			}elseif(file_exists("views/student/".$this->v)) {
				include("views/student/".$this->v);
			}elseif(file_exists("views/shared/".$this->v)) {
				include("views/shared/".$this->v);
			} else {
				include("views/".$this->v);
			}		
		}
	}

	public function show404() {
		echo "page 404";
	}

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}

	public function addModal($modal, $config, $errors = []) {
		include("views/modals/".$modal.".mdl.php");
	}

}