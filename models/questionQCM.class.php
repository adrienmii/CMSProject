<?php

class QuestionQCM extends BaseSQL {
	protected $id = null;
	protected $question;
	protected $answer1;
	protected $answer2;
	protected $answer3;
	protected $answer4;
	protected $result;
	protected $idQCM;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;
    }

    public function getAnswer1()
    {
        return $this->answer1;
    }

    public function setAnswer1($answer1)
    {
        $this->answer1 = $answer1;
    }

    public function getAnswer2()
    {
        return $this->answer2;
    }

    public function setAnswer2($answer2)
    {
        $this->answer2 = $answer2;
    }

    public function getAnswer3()
    {
        return $this->answer3;
    }

    public function setAnswer3($answer3)
    {
        $this->answer3 = $answer3;
    }

    public function getAnswer4()
    {
        return $this->answer4;
    }

    public function setAnswer4($answer4)
    {
        $this->answer4 = $answer4;
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    public function getIdQCM()
    {
        return $this->idQCM;
    }

    public function setIdQCM($idQCM)
    {
        $this->idQCM = $idQCM;
    }

    public function generateFormQCM() {
        $BaseSQL = new BaseSQL();
        $options = $BaseSQL->getAllClasses();

        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
                "question" => ["type" => "text", "required" => true, "placeholder" => "Question", "id" => "inputQuestion"],
                "answer1" => ["type" => "text", "required" => true, "placeholder" => "Réponse 1", "answer" => true, "id" => "inputAnswer1", "answerId" => "1"],
                "answer2" => ["type" => "text", "required" => true, "placeholder" => "Réponse 2", "answer" => true, "id" => "inputAnswer2", "answerId" => "2"],
                "answer3" => ["type" => "text", "placeholder" => "Réponse 3", "answer" => true, "id" => "inputAnswer3", "answerId" => "3"],
                "answer4" => ["type" => "text", "placeholder" => "Réponse 4", "answer" => true, "id" => "inputAnswer4", "answerId" => "4"]

            ],
            "submit" => "Suivant"
        ];
    }



}