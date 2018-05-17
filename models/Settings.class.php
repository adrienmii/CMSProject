<?php

class Settings extends BaseSQL {
	protected $id = null;
	protected $sitename;
	protected $logo;
	protected $address;

	public function __construct($id = null) {
		parent::__construct();
		if ($id != null) {
			$this->id = $id;
		}
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setSitename($sitename) {
		$this->sitename = $sitename;
	}

	public function setLogo($logo) {
		$this->logo = $logo;
	}

	public function setAddress($address) {
		$this->address = $address;
	}

	public function getId() {
		return $this->id;
	}

	public function getSitename() {
		return $this->sitename;
	}

	public function getLogo() {
		return $this->logo;
	}

	public function getAddress() {
		return $this->Address;
	}


	 public function generateForm() {
        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
                "sitename" => ["type" => "text", "placeholder" => "Nom de l'école", "required" => true, "id" => "sitename"],
                 "address" => ["type" => "text", "placeholder" => "Adresse de l'école", "required" => true, "id" => "address"],
                "logo" => ["type" => "file", "placeholder" => "Logo", "id" => "logo"],
      
            ],
            "submit" => "Enregistrer"
        ];
    }

}