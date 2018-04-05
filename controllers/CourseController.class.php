<?php

class CourseController {
	

	public function showAction($params) {		

		$v = new View("myCourses", "front");
		
	}

	public function showChapterAction($params) {		

		$v = new View("chapter", "front");
		
	}
	
	public function addAction($params) {		

		$v = new View("addChapter", "front");
		
	}

	public function editAction($params) {		

		$v = new View("addChapter", "front");
		
	}
	
}