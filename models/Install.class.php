<?php

class Install extends BaseSQL {
	

    public function generateForm() {
        return [
            "config" => ["method"=> "POST", "action" => ""],
            "input" => [
                "dbname" => ["type" => "text", "label" => "Nom de la base", "required" => true, "desc" => "Le nom de la base de données sur laquelle vous souhaitez installer Edulab.®","id" => "dbName", "example" => "edulab"],
                "user" => ["type" => "text", "label" => "Utilisateur", "required" => true, "desc" => "Le nom d'utilisateur de votre base de données","id" => "user", "example" => "root"],
                "pwd" => ["type" => "password", "label" => "Mot de passe", "required" => true, "desc" => "...et le mot de passe associé","id" => "pwd", "example" => ""],
               	"host" => ["type" => "text", "label" => "Nom d'hôte", "required" => true, "desc" => "Le nom d'hôte de la base de données","id" => "host", "example" => "localhost"],

                "port" => ["type" => "text", "label" => "Port", "desc" => "Le port de la base de données si nécessaire. Peut être vide.","id" => "port", "example" => ""],
              
            ],
            "submit" => "Installer"
        ];
    }


}