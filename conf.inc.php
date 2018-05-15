<?php

	define("DBHOST", "localhost");
	define("DBPORT", "");
	define("DBNAME", "");
	define("DBUSER", "root");
	define("DBPWD", "");
	define("DBDRIVER", "mysql");
	define("DS", "/");
	$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
	define("DIRNAME", $scriptName.DS);