<?php

class Chapter extends BaseSQL {
	protected $id = null;
	protected $label;
	protected $description;
	protected $classe;

	public function __construct($id = null) {
		parent::__construct();
		if ($id != null) {
			$this->id = $id;
		}
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setLabel($label) {
		$this->label = $label;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function setClasse($classe) {
		$this->classe = $classe;
	}

	public function getId() {
		return $this->id;
	}

	public function getLabel() {
		return $this->label;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getClasse() {
		return $this->classe;
	}

	public function generateFormAddChapter() {
		$BaseSQL = new BaseSQL();
        $options = $BaseSQL->getAllClasses();

        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
            	"label" => ["type" => "text", "placeholder" => "Nom du chapitre", "required" => true, "id" => "inputLabesl"],
                "description" => ["type" => "text", "placeholder" => "Description", "id" => "inputDescription"],
                "classe" => ["type" => "select", "options" => $options, "required" => true, "id" => "inputClasse"]
               
            ],
            "submit" => "Valider"
        ];
    }

}