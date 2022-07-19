<?php

/**
 * Env var
 */
//require 'vendor/autoload.php';




/**
 * Class for the connexion to the database
 */
class Database
{

    /**
     * @var $connexion
     */


    public mixed $connexion;

    /**
     * @return PDO|null
     * connexion function
     */
    public function getConnection(): ?PDO
    {

        $this->connexion = null;

        try
        {

            $this->connexion = new PDO('mysql:host=db;dbname=data', 'root', 'password');
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception)
        {
            echo "Connexion error : " . $exception->getMessage();
        }

        return $this->connexion;

    }



}