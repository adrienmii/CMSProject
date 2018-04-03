<?php

class User extends BaseSQL {
	protected $id = null;
	protected $firstname;
	protected $lastname;
	protected $email;
	protected $pwd;
	protected $token;
	protected $status = 0;

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
			$this->token = substr(sha1("a64d1c9bfa6343".substr(time(), 5).uniqid()."148542cf0205cdd"), 2, 10);
		}
		
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function getToken() {
		return $this->token;
	}

}