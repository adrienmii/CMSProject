<?php

class QCM extends BaseSQL {
	protected $id = null;
	protected $label;

    public function __construct($id = null) {
        parent::__construct();
        if ($id != null) {
            $this->id = $id;
            $this->label = $this->getQCMById($this->id)['label'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
    }

    public function generateFormQCM() {
        $BaseSQL = new BaseSQL();
        $options = $BaseSQL->getAllClasses();

        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
                "label" => ["type" => "text", "required" => true, "placeholder" => "Titre du QCM", "id" => "inputLabel"],

            ],
            "submit" => "Créer le QCM"
        ];
    }



}