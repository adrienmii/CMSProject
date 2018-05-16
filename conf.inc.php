<?php
define("DBHOST", "localhost");
define("DBPORT", "");
define("DBNAME", "EDULAB");
define("DBUSER", "root");
define("DBPWD", "root");
define("DBDRIVER", "mysql");
define("DS", "/");
define("DBBONFIGURED", true);
$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
define("DIRNAME", $scriptName.DS);