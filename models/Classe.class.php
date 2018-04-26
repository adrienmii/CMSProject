<?php

class Classe extends BaseSQL {
	protected $id = null;
	protected $classname;

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

	public function getId() {
		return $this->id;
	}

	public function getClassname() {
		return $this->classname;
	}

	public function generateForm() {
		$BaseSQL = new BaseSQL();
        $options = $BaseSQL->getTeachersAndAdmin();
		return [
					"config" => ["method"=> "POST", "action" => ""],
					"input" => [
						"classname" => ["type" => "text", "placeholder" => "Nom de la classe", "required" => true, "id" => "inputClassName"],
						"teachers[]" => ["type" => "select", "options" => $options, "required" => true, "multiple" => true, "id" => "selectTeachers"]
					],
					"submit" => "Créer"
		];
	}

	public function generateFormStudents() {
		$BaseSQL = new BaseSQL();
        $options = $BaseSQL->studentsWithoutClasse();
		return [
					"config" => ["method"=> "POST", "action" => ""],
					"input" => [
						"students[]" => ["type" => "select", "options" => $options, "required" => true, "multiple" => true, "id" => "selectStudents"]
					],
					"submit" => "Valider"
		];
	}

	public function generateFormTeachers($id) {
		$BaseSQL = new BaseSQL();
        $options = $BaseSQL->teachersExceptClasseId($id);
		return [
					"config" => ["method"=> "POST", "action" => ""],
					"input" => [
						"teachers[]" => ["type" => "select", "options" => $options, "required" => true, "multiple" => true, "id" => "selectTeachers"]
					],
					"submit" => "Valider"
		];
	}



}