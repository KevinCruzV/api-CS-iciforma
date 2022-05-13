<?php

/**
 * Env var
 */
require_once "../vendor/autoload.php";
require_once 'env.php';

/**
 * Class for the connexion to the database
 */
class Database
{

    /**
     * @var $connexion
     */
    public $connexion;

    /**
     * @return PDO|null
     * connexion function
     */
    public function getConnection(): ?PDO
    {

        $this->connexion = null;

        try
        {
            $this->connexion = new PDO("mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_DATABASE"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception)
        {
            echo "Connexion error : " . $exception->getMessage();
        }

        return $this->connexion;

    }



}