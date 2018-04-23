<?php

class Mail {
	private $to;
	private $subject;
	private $body;
	private $headers;
	private $data;

	const FROM = 'no_reply@edulab.com';
	const SEPERATOR = '\r\n';

	public function __construct($to, $subject = 'Sujet par défaut', $body = null, $data = null) {

		$this->to = filter_var($to, FILTER_VALIDATE_EMAIL);

		$this->subject = $subject;

		$this->data = $data;

		$this->headers = 'MIME-Version: 1.0' . self::SEPERATOR;
     	$this->headers .= 'Content-type: text/html; charset=utf-8' . self::SEPERATOR;
     	$this->headers .= 'From: EDULAB <"'.self::FROM.'">' . self::SEPERATOR;

	}

	public function send() {
		return mail($this->to, $this->subject, $this->body, $this->headers);
	}

}
