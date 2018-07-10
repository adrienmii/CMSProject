<?php

class ScheduleSettings extends BaseSQL {
	protected $id = null;
	protected $days;
	protected $firstHour;
	protected $lastHour;
	protected $lunchTime;
	protected $lunchHour;
	protected $courseTime;

	public function __construct($id = null) {
		parent::__construct();
		if ($id != null) {
			$this->id = $id;
		}
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setDays($days) {
		$this->days = $days;
	}

	public function setFirstHour($firstHour) {
		$this->firstHour = $firstHour;
	}

	public function setLastHour($lastHour) {
		$this->lastHour = $lastHour;
	}

	public function setLunchTime($lunchTime) {
		$this->lunchTime = $lunchTime;
	}

	public function setLunchHour($lunchHour) {
		$this->lunchHour = $lunchHour;
	}

	public function setCourseTime($courseTime) {
		$this->courseTime = $courseTime;
	}

	public function getId() {
		return $this->id;
	}

	public function getDays() {
		return $this->days;
	}

	public function getFirstHour() {
		return $this->firstHour;
	}

	public function getLastHour() {
		return $this->lastHour;
	}

	public function getLunchTime() {
		return $this->lunchTime;
	}

	public function getLunchHour() {
		return $this->lunchHour;
	}

	public function getCourseTime() {
		return $this->courseTime;
	}


	public function generateForm() {
		$BaseSQL = new BaseSQL();
		return [
			"config" => ["method"=> "POST", "action" => ""],
			"input" => [
				"days" => ["type" => "number", "placeholder" => "Nombre de jours pour une semaine", "required" => true, "id" => "inputDays"],
				"firstHour" => ["type" => "text", "placeholder" => "Heure du premier cours de la journée (exemple: 08:00)", "required" => true, "id" => "inputFirstHour"],
				"lastHour" => ["type" => "text", "placeholder" => "Heure du dernier cours de la journée (exemple: 17:00)", "required" => true, "id" => "inputLastHour"],
				"lunchTime" => ["type" => "text", "placeholder" => "Durée de la pause du midi (exemple: 01:00)", "required" => true, "id" => "inputLunchTime"],
				"lunchHour" => ["type" => "text", "placeholder" => "Heure de la pause du midi (exemple: 12:00)", "required" => true, "id" => "inputLunchHour"],
				"courseTime" => ["type" => "text", "placeholder" => "Durée d'un cours (exemple: 01:00)", "required" => true, "id" => "inputCourseTime"],
			],
			"submit" => "Valider"
		];
	}


}