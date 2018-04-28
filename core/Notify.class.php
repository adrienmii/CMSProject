<?php
class Notify {

	private $message;
	private $state;
	private $result;


	public function __construct($message = null, $state = null) {	
		$this->message = $message;
		$this->state = $state;

		if(is_string($this->message)){
			//$result = "<div id='notify' class='show ".$this->state."'>".$this->message."</div>";
			echo("ici");
			echo("<script>showNotify('".$this->message."');</script>");
		}else{			
			$result ="<div id='notify' class='show ".$this->state."'><ul>";
			foreach ($message as $value) {
				$result = $result."<li>".$value."</li>";
			}
			$result = $result."</ul></div>";
		}

		//echo($result);
	
	}

}