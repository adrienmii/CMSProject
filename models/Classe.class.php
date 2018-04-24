<?php

class Classe extends BaseSQL {
	protected $id = null;
	protected $classname;
	protected $teacher;

	public function __construct($id = null) {
		parent::__construct();
		if ($id != null) {
			$this->id = $id;
		}
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setClassname($classname) {
		$this->classname = $classname;
	}

	public function setTeacher($teacher) {
		$this->teacher = $teacher;
	}

	public function getId() {
		return $this->id;
	}

	public function getClassname() {
		return $this->classname;
	}

	public function getTeacher() {
		return $this->teacher;
	}

	public function generateForm() {
		return [
					"config" => ["method"=> "POST", "action" => ""],
					"input" => [
						"classname" => ["type" => "text", "placeholder" => "Nom de la classe", "required" => true, "id" => "inputClassName"],
						"teacher" => ["type" => "text", "placeholder" => "Prof", "required" => true, "id" => "inputTeacher"]
					],
					"submit" => "Créer"
		];
	}



}