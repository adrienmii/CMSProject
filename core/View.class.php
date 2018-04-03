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
		if (!file_exists("views/".$this->v)) {
			die("La vue ".$this->v." n'existe pas.");
		}
	}

	public function __destruct() {
		global $c, $a; // va chercher une variable globale déclarée plus tôt
		extract($this->data); // transforme les clés du tableau en variables
		include("views/templates/".$this->t); // dans le destruct pour pouvoir passer des paramètres avant l'affichage
	}

	public function show404() {
		echo "page 404";
	}

	public function assign($key, $value) {
		$this->data[$key] = $value;
	}

}