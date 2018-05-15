<?php

class Course extends BaseSQL {
	protected $id = null;
	protected $title;
    protected $content;
    protected $teacher;
	protected $chapter;

    public function __construct($id = null) {
        parent::__construct();
        if ($id != null) {
            $this->id = $id;
        }
    }

    public function getChapter()
    {
        return $this->chapter;
    }

    public function setChapter($chapter)
    {
        $this->chapter = $chapter;
    }

    public function getTeacher()
    {
        return $this->teacher;
    }

    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function generateFormAddCourse() {
        $options = $this->getChapters($this->userInfoByToken()['id']);

        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
                "title" => ["type" => "text", "placeholder" => "Titre du cours", "required" => true, "id" => "inputTitle"],
                "chapter" => ["type" => "select", "options" => $options, "required" => true, "id" => "inputChapter"]
            ],
            "textarea" => [
                "content" => ["required" => true, "id" => "textareaContent"]
            ],
            "submit" => "Enregistrer le cours"
        ];
    }


}