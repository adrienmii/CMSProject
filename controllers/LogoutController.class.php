<?php

class LogoutController {

	public function indexAction($params) {
		session_destroy();

		header("Location: ".DIRNAME."login");
		exit();

	}


}