<?php

class ClassController {

	public function indexAction($params) {		

		$v = new View("classes", "front");
		
	}

	public function getClassStundentAction($params) {		

		$v = new View("class", "front");
		
	}

	public function getTeacherClassesAction($params) {		

		$v = new View("myclasses", "front");
		
	}




}