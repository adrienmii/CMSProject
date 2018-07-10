<?php

class ParticipateQCM extends BaseSQL {
	protected $id = null;
	protected $idUser;
	protected $idQCM;
	protected $mark;

    public function __construct($id = null) {
        parent::__construct();
        if ($id != null) {
            $this->id = $id;
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

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }

    public function getIdQCM()
    {
        return $this->idQCM;
    }

    public function setIdQCM($idQCM)
    {
        $this->idQCM = $idQCM;
    }

    public function getMark()
    {
        return $this->mark;
    }

    public function setMark($mark)
    {
        $this->mark = $mark;
    }


}