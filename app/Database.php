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


    var string $dsn = 'mysql:dbname=data;host=db';
    var string $user ='root';
    var string $password ='password';
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

            $this->connexion = new PDO('mysql:host=pagesap2323.mysql.db;dbname=pagesap2323', 'pagesap2323', 'SOIJSD2239023dfds');
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception)
        {
            echo "Connexion error : " . $exception->getMessage();
        }

        return $this->connexion;

    }



}