<?php

class Token
{
    /**
     * @var $connexion
     * connexion db
     */
    private $connexion;
    /**
     * @var string $table
     * Db table
     */
    private $table = "token";

    public $id;
    public $acces_token;

    /**
     * @param $connexion
     */
    public function __construct($db)
    {
        $this->connexion = $db;
    }




    public function is_table_empty(): bool
    {

        $result = $this->connexion->query("SELECT id FROM ". $this->table);
        if($result->num_rows) {
            return false;
        }

        return true;
    }

    public function get_access_token() {
        $sql = $this->connexion->query("SELECT access_token FROM ". $this->table);
        $result = $sql->fetch_assoc();
        return json_decode($result['access_token']);
    }

    public function get_refersh_token() {
        $result = $this->get_access_token();
        return $result->refresh_token;
    }

    public function update_access_token($token) {

        if($this->is_table_empty()) {

            $this->connexion->query("INSERT INTO token(access_token) VALUES('$token')");

        } else {

            $this->connexion->query("UPDATE token SET access_token = '$token' WHERE id = (SELECT id FROM token)");

        }
    }
}