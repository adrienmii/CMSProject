<?php

class User extends BaseSQL {
	protected $id = null;
	protected $firstname;
	protected $lastname;
	protected $email;
	protected $pwd;
	protected $token;
	protected $rank;
	protected $status;
	protected $classe;
	protected $pwd_changed;

	public function __construct($id = null) {
		parent::__construct();
		if ($id != null) {
			$this->id = $id;
		}
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setFirstname($firstname) {
		$this->firstname = ucfirst(strtolower(trim($firstname)));
	}

	public function setLastname($lastname) {
		$this->lastname = strtoupper(trim($lastname));
	}

	public function setEmail($email) {
		$this->email = strtolower(trim($email));
	}

	public function setPwd($pwd) {
		$this->pwd = password_hash($pwd, PASSWORD_DEFAULT);
	}

	public function setToken($token = null) {
		if ($token)  {
			$this->token = $token;
		} elseif ($token == 1) {
			$this->token = "";
		} else {
			$this->token = substr(sha1("a64d1c9bfa6343".substr(time(), 5).uniqid()."148542cf0205cdd"), 2, 15);
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getToken() {
		return $this->token;
	}

    public function getRank()
    {
        return $this->rank;
    }

    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    public function setPwdChanged($pwd_changed)
    {
        $this->pwd_changed = $pwd_changed;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

	public function getEmail() {
		return $this->email;
	}

	public function getFirstname() {
		return $this->firstname;
	}

	public function getPwdChanged() {
		return $this->pwd_changed;
	}

	public function generateLoginForm() {
		return [
					"config" => ["method"=> "POST", "action" => ""],
					"input" => [
						"email" => ["type" => "text", "placeholder" => "E-mail", "required" => true, "id" => "inputLogin"],
						"pwd" => ["type" => "password", "placeholder" => "Mot de passe", "required" => true, "id" => "inputPwd"],
                        "captcha" => ["type" => "text", "placeholder" => "Captcha", "required" => true, "id" => "inputCaptcha"]
					],
					"submit" => "Se connecter"
		];
	}


    public function generateAddUserForm() {
        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
            	"rank" => ["type" => "select", "options" => [0 => "Rôles", 1 => "Administrateur", 2 => "Professeur", 3 => "Elève"], "required" => true, "id" => "selectRank"],
                "email" => ["type" => "text", "placeholder" => "E-mail", "required" => true, "id" => "inputEmail"],
                "name" => ["type" => "text", "placeholder" => "Nom", "required" => true, "id" => "inputName"],
                "firstname" => ["type" => "text", "placeholder" => "Prénom", "required" => true, "id" => "inputFirstname"]
               
            ],
            "submit" => "Enregistrer"
        ];
    }

    public function generateInstallForm() {
        return [
            "config" => ["method"=> "POST", "action" => ""],
            "titles" => ["head" => "Création du premier utilisateur", "sub" => "Utiliez le formulaire ci-dessous pour vous créer un compte administrateur"],
            "input" => [

                "lastname" => ["type" => "text", "label" => "Nom", "required" => true, "id" => "inputLastname", "example" => "", "desc" => "Le nom de l'admin"],
                "firstname" => ["type" => "text", "label" => "Prénom", "required" => true, "id" => "inputFirstname", "example" => "", "desc" => "...son prénom"],

                "email" => ["type" => "text", "label" => "E-mail", "required" => true, "id" => "inputEmail", "example" => "", "desc" => "Une adresse e-mail valide"],
                "pwd" => ["type" => "password", "label" => "Mot de passe", "required" => true, "id" => "inputFirstname", "example" => "", "desc" => "Un mot de passe fort (1 majuscule, 1 minuscule, 1 chiffre et plus de 5 caractères)"]
               
            ],
            "submit" => "Créer"
        ];
    }


    public function generateEditUserForm() {
        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
            	"rank" => ["type" => "select", "options" => [1 => "Administrateur", 2 => "Professeur", 3 => "Elève"], "required" => true, "id" => "selectRank"],
                "email" => ["type" => "text", "placeholder" => "E-mail", "required" => true, "id" => "inputEmail"],
                "pwd" => ["type" => "password", "placeholder" => "Modifier le mot de passe", "id" => "inputPwdEdit"],
                "lastname" => ["type" => "text", "placeholder" => "Nom", "required" => true, "id" => "inputName"],
                "firstname" => ["type" => "text", "placeholder" => "Prénom", "required" => true, "id" => "inputFirstname"]                
            ],
            "submit" => "Enregistrer"
        ];
    }

    public function generateNewPwdUserForm() {
        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
                "pwd" => ["type" => "password", "placeholder" => "Nouveau mot de passe", "id" => "inputNewPwd"],    
                "pwd2" => ["type" => "password", "placeholder" => "Confirmation du nouveau mot de passe", "id" => "inputNewPwd2"]                           
            ],
            "submit" => "Modifier"
        ];
    }


}