<?php
class Lead {
    /**
     * @var $connexion
     * connexion db
     */
    private $connexion;
    /**
     * @var string $table
     * Db table
     */
    private $table = "lead";


    /**
     * object properties
     */

    public $id;
    public $civilite;
    public $nom;
    public $prenom;
    public $tel;
    public $email;
    public $ville;
    public $code_postal;
    public $statut;
    public $horaire_rappel;
    public $formation_ou_client;
    public $client_id;
    public $created_at;
    public $update_at;

    /**
     * @param $connexion
     */
    public function __construct($db)
    {
        $this->connexion = $db;
    }

    /**
     * @return mixed
     * read leads
     */
    public function lire()
    {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";

        $query = $this->connexion->prepare($sql);

        $query->execute();

        return $query;
    }


}