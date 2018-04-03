<?php

class IndexController {
	public function indexAction($params) {
		$name = "audric";

		$v = new View("default", "front");
		$v->assign("name", $name);
	}
}