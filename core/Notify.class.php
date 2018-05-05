<?php
class Notify {

	private $message;
	private $state;
	private $result;


	public function __construct($message = null, $state = null) {			
		$this->state = $state;
		if(is_string($message)){
			$this->message = htmlspecialchars($message, ENT_QUOTES); // on échappe éviter des erreurs à cause des simples quotes			
		}else{
			foreach ($message as $value) {
				$this->message = htmlspecialchars($value, ENT_QUOTES)."<br>";
			}
		}
		if (!empty($_SESSION['ntf'])) {
			$_SESSION['ntf'] .= "<script>showNotify('".$this->message."', '".$this->state."');</script>";
	 	} else {
	 		$_SESSION['ntf'] = "<script>showNotify('".$this->message."', '".$this->state."');</script>";
	 	}
	
	}

}