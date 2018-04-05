<?php

class UserController {
	public function indexAction($params) {
		echo "Action par défaut d'un User";
	}
	public function addAction($params) {
		$v = new View("add", "front");

		$user = new User();
		$user->setFirstname("Audric");
		$user->setLastname("MATI");
		$user->setEmail("audric.mati@bnpparibas.com");
		$user->setPwd("monmotdepasse");
		$user->setToken();
		$user->save();
	}
	public function editAction($params) {
		echo "Action de modification d'un User";

		$user = new User();
		$user->setId($params['URL'][0]);
		$user->setFirstname("Lolilol");
		$user->save();
	}
	public function removeAction($params) {
		echo "Action de supression d'un User";
		echo var_dump($params);
	}

}