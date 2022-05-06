<?php

/**
 * Class for the connexion to the database
 */
class Database
{
    /**
     * @var string $host
     */
    private $host = "localhost";
    /**
     * @var string $db_name
     */
    private $db_name = "api_iciF_cs";
    /**
     * @var string $username
     */
    private $username = "root";
    /**
     * @var string $password
     */
    private $password = "password";
    /**
     * @var $connexion
     */
    public $connexion;

    public function getConnexion()
    {

        $this->connexion = null;

        try
        {
            $this->connexion = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception)
        {
        //
        }

    }



}