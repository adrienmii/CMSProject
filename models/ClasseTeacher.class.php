<?php

class ClasseTeacher extends BaseSQL {
	protected $id = null;
	protected $classe;
	protected $teacher;

	public function __construct($id = null) {
		parent::__construct();
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setClasse($classe) {
		$this->classe = $classe;
	}

	public function setTeacher($teacher) {
		$this->teacher = $teacher;
	}

	public function getId() {
		return $this->id;
	}

	public function getClasse() {
		return $this->classe;
	}

	public function getTeacher() {
		return $this->teacher;
	}
}
