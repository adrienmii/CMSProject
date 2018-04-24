<?php

class Mail {
	private $to;
	private $subject;
	private $body;
	private $headers;
	private $data;

	const FROM = 'no_reply@edulab.com';

	public function __construct($to, $subject = null, $body = null, $data = null) {
		// test mail valide
		if (!$this->to = filter_var($to, FILTER_VALIDATE_EMAIL)) {
			throw new InvalidArgumentException("E-mail destinataire invalide.");
		}

		// test sujet existe
		if (empty($subject) || ($subject == null)) {
			throw new InvalidArgumentException("Sujet du mail manquant.");
		} else {
			$this->subject = $subject;
		}

		// test body existe
		if (empty($body) || ($body == null)) {
			throw new InvalidArgumentException("Body du mail manquant.");
		} else {
			$this->body = $body;
		}

		// si tableau de data fourni alors remplacer dans le body les clés
		if (!empty($data)) {
			$html = null;
			if(is_string($data) && strlen($data) != strlen(strip_tags($data))) { 
				$html = $data;
			} elseif(is_array($data) && !empty($body)) {
				$html = $body;
			}
			foreach($data as $key => $value) {
				$html = str_replace('#'.strtoupper($key).'#', nl2br($value), $html);
			}
			$this->body = $html;
		}

		// formation du header du mail (html)
		$this->headers = "From: \"EDULAB.\"<".self::FROM.">\n";
  		$this->headers .= "Content-Type: text/html; charset=\"UTF-8\"";

	}

	public function send() {
		return mail($this->to, $this->subject, $this->body, $this->headers);
	}

}
