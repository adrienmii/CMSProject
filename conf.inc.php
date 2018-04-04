<?php

	define("DBHOST", "localhost");
	define("DBPORT", "3306");
	define("DBNAME", "edulab");
	define("DBUSER", "root");
	define("DBPWD", "root");
	define("DBDRIVER", "mysql");
	define("DS", "/");
	$scriptName = (dirname($_SERVER['SCRIPT_NAME']) == "/")?"":dirname($_SERVER['SCRIPT_NAME']);
	define("DIRNAME", $scriptName.DS);