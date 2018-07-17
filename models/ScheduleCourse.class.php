<?php

class ScheduleCourse extends BaseSQL {

    protected $id = null;
	protected $matiere;
	protected $room;
	protected $startHour;
	protected $day;
	protected $week;
	protected $classID;
    protected $userID;
    
    public function __construct($id = null) {
		parent::__construct();
		if ($id != null) {
			$this->id = $id;
		}
	}

	public function setId($id) {
		$this->id = $id;
    }

    public function setMatiere($matiere) {
		$this->matiere = $matiere;
    }

    public function setRoom($room) {
		$this->room = $room;
    }

    public function setStartHour($startHour) {
		$this->startHour = $startHour;
    }

    public function setDay($day) {
		$this->day = $day;
    }

    public function setWeek($week) {
		$this->week = $week;
    }

    public function setClassID($classID) {
		$this->classID = $classID;
    }

    public function setUserID($userID) {
		$this->userID = $userID;
    }
    
    public function getId() {
		return $this->id;
    }
    
    public function getMatiere() {
		return $this->matiere;
    }
    
    public function getRoom() {
		return $this->room;
    }
    
    public function getStartHour() {
		return $this->startHour;
    }

    public function getDay() {
		return $this->day;
	}
    
    public function getWeek() {
		return $this->week;
    }
    
    public function getClassID() {
		return $this->classID;
    }
    
    public function getUserID() {
		return $this->userID;
    }
    
    public function generateForm($week,$day,$hour) {
        $BaseSQL = new BaseSQL();
        $options = $BaseSQL->teacherWithoutCourses($week,$day,$hour);
		return [
			"config" => ["method"=> "POST", "action" => ""],
			"input" => [
				"matiere" => ["type" => "text", "placeholder" => "Matière", "required" => true, "id" => "inputMatiere"],
                "room" => ["type" => "text", "placeholder" => "Salle de classe", "required" => true, "id" => "inputRoom"],
                "userID" => ["type" => "select", "options" => $options, "required" => true, "id" => "selectTeacher"]
			],
			"submit" => "Valider"
		];
	}

}