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
    private $db_name = "data";
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

    /**
     * @return PDO|null
     * connexion function
     */
    public function getConnection()
    {

        $this->connexion = null;

        try
        {
            $this->connexion = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception)
        {
            echo "Connexion error : " . $exception->getMessage();
        }

        return $this->connexion;

    }



}